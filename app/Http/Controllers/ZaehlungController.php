<?php

namespace App\Http\Controllers;

use App\Zaehlung;
use App\Exports\ZaehlungpositionExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ZaehlungController extends Controller
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
    public function index()
    {
        $zaehlungen = DB::select('  SELECT  zaehlungs.*, 
                                            users.name, 
                                            (SELECT COUNT(*) FROM comments WHERE comments.zaehlung_id = zaehlungs.id) AS anzahl_comments, 
                                            (SELECT SUM(comments.erledigt) FROM comments WHERE comments.zaehlung_id = zaehlungs.id) AS sum_erledigt
                                    FROM zaehlungs 
                                    JOIN users ON zaehlungs.bearbeiter_id = users.id 
                                    WHERE DATE(zaehlungs.created_at) = CURDATE()');
        
        if (count($zaehlungen) > 0) {

            $alle_zaehlungen = DB::select(' SELECT  zaehlungs.*, 
                                                    users.name, 
                                                    (SELECT COUNT(*) FROM comments WHERE comments.zaehlung_id = zaehlungs.id) AS anzahl_comments,
                                                    (SELECT SUM(comments.erledigt) FROM comments WHERE comments.zaehlung_id = zaehlungs.id) AS sum_erledigt
                                            FROM zaehlungs 
                                            JOIN users ON zaehlungs.bearbeiter_id = users.id 
                                            WHERE zaehlungs.id != '.$zaehlungen[0]->id.' 
                                            ORDER BY 1 DESC');

            return view('zaehlung.home')->with('var', [
                'zaehlungen' => $zaehlungen,
                'alle_zaehlungen' => $alle_zaehlungen
            ]); 
        } else {

            $alle_zaehlungen = DB::select(' SELECT  zaehlungs.*, 
                                                    users.name, 
                                                    (SELECT COUNT(*) FROM comments WHERE comments.zaehlung_id = zaehlungs.id) AS anzahl_comments,
                                                    (SELECT SUM(comments.erledigt) FROM comments WHERE comments.zaehlung_id = zaehlungs.id) AS sum_erledigt
                                            FROM zaehlungs 
                                            JOIN users ON zaehlungs.bearbeiter_id = users.id 
                                            ORDER BY 1 DESC');

            return view('zaehlung.erstellen')->with('var', [
                'alle_zaehlungen' => $alle_zaehlungen
            ]);
        }
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
        $programm = DB::select('SELECT id FROM programms WHERE DATE(NOW()) BETWEEN programms.von AND programms.bis');

        if (sizeof($programm) == 0)
        {
            return redirect()->back()->with('status', ['error' => 'Für heute existiert noch kein Programm']);
        }

        $zaehlung = new Zaehlung;
        $zaehlung->bearbeiter_id = Auth::user()->id;
        $zaehlung->pro_id = $programm[0]->id;
        $zaehlung->save();
        return redirect()->back()->with('status', ['success' => 'Eine neue Zählung hinzugefügt']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zaehlung  $zaehlung
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kunden = DB::select('SELECT
        kundes.id,
        kundes.name,
        (SELECT SUM(menge) FROM zaehlungpositions WHERE zaehlungpositions.zaehlung_id = ? AND zaehlungpositions.kunde_id = kundes.id ) AS summe
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
            zaehlungs.id = ?)',[$id,$id]);
        $zaehlung = DB::select('SELECT zaehlungs.*, users.name FROM zaehlungs JOIN users ON zaehlungs.bearbeiter_id = users.id WHERE zaehlungs.id = ?',[$id])[0];
        return view('zaehlung.zaehlung')->with('var', [
            'zaehlung' => $zaehlung,
            'kunden' => $kunden,
            'id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zaehlung  $zaehlung
     * @return \Illuminate\Http\Response
     */
    public function edit(Zaehlung $zaehlung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zaehlung  $zaehlung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zaehlung $zaehlung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zaehlung  $zaehlung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zaehlung $zaehlung)
    {
        //
    }

    public function export($id) 
    {

        $wochentag = ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'];
        $datum = DB::select('SELECT DATE_FORMAT(zaehlungs.created_at, "%d.%m.%Y") datum, DATE_FORMAT(zaehlungs.created_at, "%w") wochentag FROM zaehlungs WHERE zaehlungs.id = ?',[$id])[0];
        $data = new ZaehlungpositionExport;
        $data->id = $id;

        return Excel::download($data, $wochentag[$datum->wochentag]." ".$datum->datum.".csv");
    }

    public function info($id) 
    {
        $positionen = DB::select('  SELECT 
                                        zaehlungpositions.id AS z_id, 
                                        zaehlungpositions.menge, 
                                        ggns.*,
                                        artikels.bezeichnung, 
                                        kundes.name
                                    FROM zaehlungpositions 
                                    JOIN ggns ON ggns.ggn = zaehlungpositions.ggn
                                    JOIN artikels ON artikels.id = zaehlungpositions.art_id
                                    JOIN kundes ON kundes.id = zaehlungpositions.kunde_id
                                    WHERE zaehlungpositions.zaehlung_id = ?
                                    ORDER BY name',[$id]);

        foreach ($positionen as $item) {
            $artikel = DB::select('SELECT * FROM soap_artikels WHERE soap_artikels.ggn_id = ?',[$item->id]);
            $item->artikel = $artikel;
        }
        
        return view('zaehlung.zaehlung_info')->with('var', [
            'positionen' => $positionen
        ]);
    }
}
