<?php

namespace App\Http\Controllers;

use Auth;
use App\Ggn;
use App\SoapArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MySoap;
use App\CustomClass\SoapRoutines;
use Illuminate\Support\Facades\Storage;


class Synch extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        // Soap Query
        $soap = new MySoap;
        $responsprop = $soap->getBookmark();

        // Wenn leerer String zurückkommt als Antwort
        if ($responsprop == 'leer') {
            return back()->with('status', ['error' => 'Die Antwort der Global GAP Datenbank war leer :/']);
            //TODO E-Mail Versand als Fehlermeldung wenn Soap Response leer?
        }
            
        // wenn respons mit result ok
        if ($responsprop->result == 'ok') {
            
            // wenn Items vorhanden
            if (isset($responsprop->bookmarkItemList)) {

                // in Schleife die Items (GGNs) durchgehen und Infos zum Lieferanten + GRASP + Produkte
                foreach ( $responsprop->bookmarkItemList->bookmarkItem as $item )  {

                    // nur bei Items die new oder changed sind
                    if ($item->attributes()->{'status'} == 'NEW' || $item->attributes()->{'status'} == 'CHANGED') {

                        // GGN-id abspeichern, wird bei SoapArtikel verwendet
                        $soap_artikel_ggn_id = $item->organisationalData->bookmarkItemId;

                        // vermeiden von "Creating default object from empty value"
                        $ggn_table = new \stdClass();
                        $ggn_table->erzeuger = new \stdClass();
                        $ggn_table->country = new \stdClass();
                        $ggn_table->company_type = new \stdClass();

                        $ggn_table = Ggn::find($item->organisationalData->bookmarkItemId);
                        $ggn_table->erzeuger = $item->producerData->name->lastName;
                        $ggn_table->country = $item->producerData->country;
                        $ggn_table->company_type = $item->producerData->companyType;
                        
                        // komische GGNs mit Zugriff nicht gewährt
                        if (!isset($item->productDataList->productData)) {
                            $ggn_table->erzeuger = "Broken GGN: ({$item->producerData->name->lastName})";
                            $ggn_table->save();
                            continue;
                        }

                        // Producte durchgehen und nach GRASP und GROUPGGN suchen
                        foreach ($item->productDataList->productData as $product) {
                            
                            // auf GRASP prüfen
                            if ($product->productId == '99001') {

                                $ggn_table->grasp_status = $product->productStatus;
                                $ggn_table->groupggn = (isset($product->currentCycle->groupGgn)) ? $product->currentCycle->groupGgn : NULL;
                                $ggn_table->grasp_valid_to_current = (isset($product->currentCycle->certificateValidTo) && $product->currentCycle->certificateValidTo != '') ? substr($product->currentCycle->certificateValidTo, 0, 10) : NULL;
                                $ggn_table->grasp_valid_to_next = (isset($product->nextCycle->certificateValidTo) && $product->nextCycle->certificateValidTo != '') ? substr($product->nextCycle->certificateValidTo, 0, 10) : NULL;

                                // wenn Gruppen-GGN vorhanden und noch nicht in der Datenbank -> Insert Routine
                                if ($ggn_table->groupggn != NULL && Ggn::where('ggn', $ggn_table->groupggn)->count() == 0) {

                                    $insertRoutine = new SoapRoutines;
                                    if ( !$insertRoutine->ItemInsert($ggn_table->groupggn) ) {
                                        
                                        Storage::disk('soap_logs')->put('GroupGGN_InsertRoutine.ERROR', $ggn_table->groupggn.' insert hat nicht funktioniert!!!');

                                    }

                                }

                            // wenn nicht GRASP dann erzeuge einen neuen SoapArtikel    
                            } else {
                                
                                // vermeiden von "Creating default object from empty value"
                                $soap_artikel_table = new \stdClass();
                                $soap_artikel_table->ggn_id = new \stdClass();
                                $soap_artikel_table->product_id = new \stdClass();
                                $soap_artikel_table->product_name = new \stdClass();
                                $soap_artikel_table->product_status = new \stdClass();
                                $soap_artikel_table->valid_to_current = new \stdClass();
                                $soap_artikel_table->valid_to_next = new \stdClass();

                                // falls es sich um eine Änderung handelt, ersmal alle Artikel für die GGN löschen und neu befüllen
                                if ($item->attributes()->{'status'} == 'CHANGED') { SoapArtikel::where('ggn_id', $soap_artikel_ggn_id)->delete(); }

                                $soap_artikel_table = new SoapArtikel;
                                $soap_artikel_table->ggn_id = $soap_artikel_ggn_id;
                                $soap_artikel_table->product_id = $product->productId;
                                $soap_artikel_table->product_name = $product->productName;
                                $soap_artikel_table->product_status = $product->productStatus;
                                $soap_artikel_table->valid_to_current = (isset($product->currentCycle->certificateValidTo) && $product->currentCycle->certificateValidTo != '') ? substr($product->currentCycle->certificateValidTo, 0, 10) : NULL;
                                $soap_artikel_table->valid_to_next = (isset($product->nextCycle->certificateValidTo) && $product->nextCycle->certificateValidTo != '') ? substr($product->nextCycle->certificateValidTo, 0, 10) : NULL;
                                $soap_artikel_table->save();
                                
                            }
                        }

                        $ggn_table->save();

                    }

                }

                return back()->with('status', ['success' => 'Erfolgreich synchronisiert']);

            } else {

                // wenn keine Items vorhanden
                return back()->with('status', ['success' => 'Es ist bereits alles auf dem neusten Stand']);
                
            }

        } else {
            return back()->with('status', [
                'error' => 'Error'
            ]);
        }
    }
}
