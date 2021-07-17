<?php

namespace App\Http\Controllers;
use Auth;
use App\Ggn;
use App\Artikel;
use App\ggnsartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MySoap;
use App\CustomClass\SoapRoutines;
use Illuminate\Support\Facades\Storage;

class GgnController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ggns = DB::select('SELECT
                                ggns.*,
                                (
                                SELECT
                                    COUNT(*)
                                FROM
                                    soap_artikels
                                WHERE
                                    soap_artikels.ggn_id = ggns.id
                                ) AS artikel_count
                            FROM
                                ggns
                            ORDER BY
                                ggns.country ASC');

        foreach ($ggns as $item) {
            $artikel = DB::select('SELECT * FROM soap_artikels WHERE soap_artikels.ggn_id = ?',[$item->id]);
            $item->artikel = $artikel;
        }

        return view('ggns')->with('var', [
            'ggns' => $ggns
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        global $responsprop;
        $mysql_ggn_count = GGN::where('ggn', $request->ggn)->count();

        // wenn die eingegebene GGN in der lokalen Datenbank bereits vorhanden
        if ( $mysql_ggn_count > 0 ) {   
            return back()->with('status', [
                'error' => 'GGN ist bereits in der eigenen Datenbank vorhanden'
            ]);
        // wenn die eingegebene GGN nicht in der lokalen Datenbank auftaucht
        } else {

            $insertRoutine = new SoapRoutines;
            if ( $insertRoutine->ItemInsert($request->ggn) ) {
                return back()->with('status', ['success' => 'GGN <strong>'.$request->ggn.'</strong> erfolgreich hinzugefügt']);
            } else {
                return back()->with('status', [
                    'error' => 'GlobalGap-Datenbank: '.$responsprop->desc
                ]);
            }  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ggns = DB::select('select * from ggns order by ggn asc');
        $ggn_edit =  DB::select('select * from ggns where ggn = ?',[$id])[0];

        return view('ggns')->with('var', [
            'ggns' => $ggns,
            'ggn_edit' => $ggn_edit
        ]);                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        // Soap delete
        $soap = new MySoap;
        global $responsprop;
        $responsprop = $soap->bookmarkItemDelete($request->id);
        
        // wenn respons ok
        if ($responsprop->result == 'ok') {
            Ggn::destroy($request->id);
            return back()->with('status', ['success' => 'GGN <strong>'.$request->ggn.'</strong> erfolgreich gelöscht']);
        } else {
            return back()->with('status', [
                'error' => 'GlobalGap-Datenbank: '.$responsprop->desc
            ]);
        } 
    }

    public function destroymany(Request $request)
    {
        $array = explode(",", $request->string);
        return var_dump($array);
        // foreach ($array as $item) {
        //     // Soap delete
        //     $soap = new MySoap;
        //     global $responsprop;
        //     $responsprop = $soap->bookmarkItemDelete($item);

        //     return $responsprop->result;
            
        //     // wenn respons ok
        //     if ($responsprop->result == 'ok') {
        //         Ggn::destroy($item);
        //         echo "ok";
        //     }
        // }
    }
}
