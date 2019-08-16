<?php

namespace App\Http\Controllers;
use Auth;
use App\Ggn;
use App\Artikel;
use App\ggnsartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MySoap;
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
        $ggns = DB::select('select * from ggns order by ggn asc');

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
        $mysql_ggn_count = GGN::where('ggn', $request->ggn)->count();

        // wenn die eingegebene GGN in der lokalen Datenbank bereits vorhanden
        if ( $mysql_ggn_count > 0 ) {   
            return back()->with('status', [
                'error' => 'GGN ist bereits in der eigenen Datenbank vorhanden'
            ]);
        // wenn die eingegebene GGN nicht in der lokalen Datenbank auftaucht
        } else {

            // Soap insert
            $soap = new MySoap;
            $responsprop = $soap->bookmarkItemInsert($request->ggn);
            
            // wenn respons ok
            if ($responsprop->result == 'ok') {
                $ggn = new Ggn;
                $ggn->ggn = $request->ggn;
                $ggn->user_name = Auth::user()->name;
                $ggn->id = $responsprop->bookmarkItemId;
                $ggn->save();

                return back()->with('status', ['success' => 'GGN <strong>'.$request->ggn.'</strong> erfolgreich hinzugefügt']);
            } else {
                return back()->with('status', [
                    'error' => 'GlobalGap-Datenbank: '.$responsprop->desc
                ]);
            }  
        }
        // $ggn = new Ggn;
        // $ggn->ggn = $request->ggn;
        // $ggn->erzeuger = $request->erzeuger;
        // $ggn->user_id = Auth::user()->id;
        
        // if (Ggn::find($request->ggn) == NULL) {
        //     $ggn->save();
        //     return redirect('/ggn')->with('status', ['success' => 'GGN <strong>'.$request->ggn.'</strong> vom Erzeuger <strong>'.$request->erzeuger.'</strong> erfolgreich hinzugefügt']);
        // } else {

        //     return redirect('/ggn')->with('status', [
        //         'error' => 'Hat leider nicht geklappt, die GGN existiert bereits.'
        //         ]);
        // }
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
        $responsprop = $soap->bookmarkItemDelete($request->id);
        
        // wenn respons ok
        if ($responsprop->result == 'ok') {
            Ggn::destroy($request->id);
            return back()->with('status', ['success' => 'GGN <strong>'.$request->ggn.'</strong> erfolgreich hinzugefügt']);
        } else {
            return back()->with('status', [
                'error' => 'GlobalGap-Datenbank: '.$responsprop->desc
            ]);
        } 
    }
}
