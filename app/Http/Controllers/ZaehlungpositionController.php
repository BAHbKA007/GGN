<?php

namespace App\Http\Controllers;

use App\Zaehlungposition;
use App\Artikel;
use App\Ggn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ZaehlungpositionController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($zaehlung_id, $kunde_id)
    {
        $kunde = DB::select('SELECT * FROM kundes WHERE kundes.id = ?',[$kunde_id])[0];
        $zaehlung = DB::select('SELECT zaehlungs.*, users.name FROM zaehlungs JOIN users ON zaehlungs.bearbeiter_id = users.id WHERE zaehlungs.id = ?',[$zaehlung_id])[0];
        $artikel = DB::select('SELECT bezeichnung, artikels.id
            FROM programmkundes
            JOIN programmkundeartikels ON programmkundeartikels.prokun_id = programmkundes.id
            JOIN artikels ON artikels.id = programmkundeartikels.art_id
            WHERE pro_id = (SELECT zaehlungs.pro_id FROM zaehlungs WHERE zaehlungs.id = ?)
            AND kun_id = ?',[$zaehlung_id, $kunde_id]);

        return view('zaehlung.zaehlung_artikel')->with('var', [
            'zaehlung' => $zaehlung,
            'kunde' => $kunde,
            'artikel' => $artikel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zaehlungposition  $zaehlungposition
     * @return \Illuminate\Http\Response
     */
    public function show($zaehlung_id, $kunde_id, $artikel_id)
    {
        $artikel = DB::select('SELECT * FROM artikels LEFT JOIN ggnsartikels ON ggnsartikels.artikel_id = artikels.id WHERE artikels.id = ? ORDER BY ggn',[$artikel_id]);
        $zaehlung = DB::select('SELECT zaehlungs.*, users.name FROM zaehlungs JOIN users ON zaehlungs.bearbeiter_id = users.id WHERE zaehlungs.id = ?',[$zaehlung_id])[0];
        $ggns = DB::select('SELECT * FROM ggnsartikels WHERE ggnsartikels.artikel_id = ? ORDER BY ggn',[$artikel_id]);

        $kunden = DB::select('SELECT
                kundes.id,
                kundes.name
            FROM
                programmkundes
            JOIN kundes ON kundes.id = programmkundes.kun_id
            WHERE
                programmkundes.pro_id =(
                SELECT
                    pro_id
                FROM
                    zaehlungs
                WHERE
                    zaehlungs.id = ?)
                AND kun_id = ?',[$zaehlung_id, $kunde_id])[0];

        return view('zaehlung.artikel')->with('var', [
            'artikel' => $artikel,
            'kunde_id' => $kunde_id,
            'artikel_id' => $artikel_id,
            'zaehlung_id ' => $zaehlung_id,
            'zaehlung' => $zaehlung,
            'kunden' => $kunden,
            'ggns' => $ggns
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zaehlungposition  $zaehlungposition
     * @return \Illuminate\Http\Response
     */
    public function edit(Zaehlungposition $zaehlungposition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zaehlungposition  $zaehlungposition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zaehlungposition $zaehlungposition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zaehlungposition  $zaehlungposition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zaehlungposition $zaehlungposition)
    {
        //
    }
}
