<?php

namespace App\Http\Controllers;

use App\Zaehlungposition;
use App\Artikel;
use App\Ggn;
use App\ggnsartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\CustomClass\MySoap;
use App\CustomClass\SoapRoutines;

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
        $comment = DB::select('SELECT * FROM comments WHERE kunde_id = ? AND zaehlung_id = ?',[$kunde_id,$zaehlung_id]);
        $zaehlung = DB::select('SELECT zaehlungs.*, users.name FROM zaehlungs JOIN users ON zaehlungs.bearbeiter_id = users.id WHERE zaehlungs.id = ?',[$zaehlung_id])[0];
        $artikel = DB::select('SELECT
            bezeichnung,
            programmkundes.kun_id,
            artikels.id,
            (
            SELECT
                SUM(zaehlungpositions.menge)
            FROM
                zaehlungpositions
            WHERE
                zaehlungpositions.art_id = artikels.id AND zaehlungpositions.kunde_id = programmkundes.kun_id AND zaehlungpositions.zaehlung_id = ?
        ) AS summe
        FROM
            programmkundes
        JOIN programmkundeartikels ON programmkundeartikels.prokun_id = programmkundes.id
        JOIN artikels ON artikels.id = programmkundeartikels.art_id
        WHERE
            pro_id =(
            SELECT
                zaehlungs.pro_id
            FROM
                zaehlungs
            WHERE
                zaehlungs.id = ?
        ) AND kun_id = ?',[$zaehlung_id, $zaehlung_id, $kunde_id]);

        return view('zaehlung.zaehlung_artikel')->with('var', [
            'zaehlung' => $zaehlung,
            'kunde' => $kunde,
            'artikel' => $artikel,
            'comment' => $comment
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

        function verheiraten() {
            global $request;
            if ( ggnsartikel::where( [ ['ggn', '=', $request->ggn ],[ 'artikel_id', '=', $request->artikel_id ],] )->count() == 0 ) {
                    
                $ggnsartikel = new ggnsartikel;
                $ggnsartikel->ggn = $request->ggn;
                $ggnsartikel->artikel_id = $request->artikel_id;
                $ggnsartikel->user_id = Auth::user()->id;
                $ggnsartikel->save();

            }
        }

        global $responsprop;

        // Checken ob schon in der Datenbank
        if (Ggn::where('ggn', $request->ggn)->count() == 0) {

            $insertRoutine = new SoapRoutines;
            if ( $insertRoutine->ItemInsert($request->ggn) ) {

                $Zaehlungposition = new Zaehlungposition;
                $Zaehlungposition->zaehlung_id = $request->zaehlung_id;
                $Zaehlungposition->kunde_id = $request->kunde_id;
                $Zaehlungposition->art_id = $request->artikel_id;
                $Zaehlungposition->ggn = $request->ggn;
                $Zaehlungposition->menge = $request->menge;

                // GGN mit artikel verheiraten
                verheiraten();

                $Zaehlungposition->save();
                
                //return redirect('zaehlung/'.$request->zaehlung_id."/kunde/".$request->kunde_id);
                return back()->with('status', ['success' => 'GGN <strong>'.$request->ggn.'</strong> erfolgreich hinzugefügt (neue GGN)']);

            } else {

                return back()->with('status', [
                    'error' => 'GlobalGap-Datenbank: '.$responsprop->desc
                ]);
            } 

        } else {
            $Zaehlungposition = new Zaehlungposition;
            $Zaehlungposition->zaehlung_id = $request->zaehlung_id;
            $Zaehlungposition->kunde_id = $request->kunde_id;
            $Zaehlungposition->art_id = $request->artikel_id;
            $Zaehlungposition->ggn = $request->ggn;
            $Zaehlungposition->menge = $request->menge;

            // GGN mit artikel verheiraten
            verheiraten();

            $Zaehlungposition->save();

            return back()->with('status', [
                'success' => 'GGN <strong>'.$request->ggn.'</strong> erfolgreich hinzugefügt'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zaehlungposition  $zaehlungposition
     * @return \Illuminate\Http\Response
     */
    public function show($zaehlung_id, $kunde_id, $artikel_id)
    {
        $comment = DB::select('SELECT * FROM comments WHERE kunde_id = ? AND zaehlung_id = ?',[$kunde_id,$zaehlung_id]);
        $artikel = DB::select('SELECT * FROM artikels LEFT JOIN ggnsartikels ON ggnsartikels.artikel_id = artikels.id WHERE artikels.id = ? ORDER BY ggn',[$artikel_id]);
        $zaehlung = DB::select('SELECT zaehlungs.*, users.name FROM zaehlungs JOIN users ON zaehlungs.bearbeiter_id = users.id WHERE zaehlungs.id = ?',[$zaehlung_id])[0];
        $ggns = DB::select('SELECT ggn FROM ggnsartikels WHERE artikel_id = ? ORDER BY ggn', [$artikel_id]);
        $gezaehlte = DB::select('SELECT zaehlungpositions.ggn, artikels.id, zaehlungpositions.menge, zaehlungpositions.id AS zaehlpos_id FROM zaehlungpositions 
                    JOIN artikels on artikels.id = zaehlungpositions.art_id
                    WHERE zaehlungpositions.zaehlung_id = ? AND zaehlungpositions.kunde_id = ? AND zaehlungpositions.art_id = ?',[$zaehlung_id, $kunde_id, $artikel_id]);

        $kunde = DB::select('SELECT
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
            'zaehlung_id' => $zaehlung_id,
            'zaehlung' => $zaehlung,
            'kunde' => $kunde,
            'ggns' => $ggns,
            'gezaehlte' => $gezaehlte,
            'comment' => $comment
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
    public function destroy(Request $request)
    {
        Zaehlungposition::destroy($request->id);
        return back()->with('status', [
            'success' => 'Position erfolgreich gelöscht'
            ]);
    }
}
