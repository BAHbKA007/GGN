<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucheController extends Controller
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
    public function suche()
    {
        return view('suche');
    }

    public function suchrgebnis(Request $request)
    {
        $suche = '%'.str_replace(' ', '%', $request->suche).'%';

        $positionen = DB::select('SELECT * FROM ggns WHERE ggns.ggn LIKE ? OR ggns.groupggn LIKE ? OR ggns.erzeuger LIKE ?',[$suche, $suche, $suche]);

        foreach ($positionen as $item) {
            $artikel = DB::select('SELECT * FROM soap_artikels WHERE soap_artikels.ggn_id = ?',[$item->id]);
            $item->artikel = $artikel;
        }

        return view('suche')->with('var', [
            'positionen' => $positionen
        ]);
    }
}
