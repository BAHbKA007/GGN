<?php

namespace App\Http\Controllers;

use Auth;
use App\Ggn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MySoap;
use Illuminate\Support\Facades\Storage;


class Synch extends Controller
{
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
            
        // wenn respons mit result ok
        if ($responsprop->result == 'ok') {
            
            // wenn Items vorhanden
            if (isset($responsprop->bookmarkItemList)) {


                // in Schleife die Items (GGNs) durchgehen und Infos zum Lieferanten + GRASP + Produkte
                foreach ( $responsprop->bookmarkItemList->bookmarkItem as $item )  {

                    // nur bei Items die new oder changed sind
                    if ($item->attributes()->{'status'} == 'NEW' || $item->attributes()->{'status'} == 'CHANGED') {

                        $ggn_table = Ggn::find($item->organisationalData->bookmarkItemId);
                        $ggn_table->erzeuger = $item->producerData->name->lastName;
                        $ggn_table->country = $item->producerData->country;
                        $ggn_table->company_type = $item->producerData->companyType;
                        
                        // Producte durchgehen und nach GRASP und GROUPGGN suchen
                        foreach ($item->productDataList->productData as $product) {
                            
                            if ($product->productId == '99001') {

                                $ggn_table->grasp_status = $product->productStatus;
                                $ggn_table->groupggn = (isset($product->currentCycle->groupGgn)) ? $product->currentCycle->groupGgn : NULL;
                                $ggn_table->grasp_valid_to_current = (isset($product->currentCycle->certificateValidTo) && $product->currentCycle->certificateValidTo != '') ? substr($product->currentCycle->certificateValidTo, 0, 10) : NULL;
                                $ggn_table->grasp_valid_to_next = (isset($product->nextCycle->certificateValidTo) && $product->nextCycle->certificateValidTo != '') ? substr($product->nextCycle->certificateValidTo, 0, 10) : NULL;

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
