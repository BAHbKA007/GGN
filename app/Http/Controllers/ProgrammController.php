<?php

namespace App\Http\Controllers;

use App\Programm;
use App\Artikel;
use App\Kunde;
use App\Dienstleistung;
use App\Programmkunde;
use App\Programmkundeartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class ProgrammController extends Controller
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
        $programm = DB::select('select programms.*, users.name from programms join users on users.id = programms.user_id order by programms.von desc');
        return view('programm_index')->with('var',[
            'programm' => $programm
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kunden = Kunde::where('sperre', 0)->get();
        $artikel = Artikel::where('sperre', 0)->get();

        return view('programm_create')->with('var',[
            'kunden' => $kunden,
            'artikel' => $artikel
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ueberschneidung_check = DB::select('   SELECT
                                                    *
            FROM
                programms
            WHERE
                programms.von BETWEEN ? AND ? OR 
                programms.bis BETWEEN ? AND ? OR ? BETWEEN programms.von AND programms.bis', [$request->von, $request->bis, $request->von, $request->bis, $request->von]
        );

        if (sizeof($ueberschneidung_check) > 0) {
            return redirect()->back()->with('status', ['error' => 'Der von Ihnen gewählte Zeitraum überschneidet sich mit dem Programm: '.$ueberschneidung_check[0]->pro_name]);
        }

        $programm = new Programm;
        $programm->von = $request->von;
        $programm->bis = $request->bis;
        $programm->user_id = Auth::user()->id;
        $programm->pro_name = $request->pro_name;
        $programm->save();
        return redirect('/programm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programm  $programm
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programmkunden = DB::select('select programmkundes.*, kundes.name, (SELECT COUNT(*) from programmkundeartikels WHERE programmkundeartikels.prokun_id = programmkundes.id ) AS art_count FROM programmkundes join kundes on kundes.id = programmkundes.kun_id where pro_id = ?', [$id]);


        $programm = DB::select('select programms.*, users.name from programms join users on programms.user_id = users.id order by programms.von desc');
        $programm_edit = DB::select('select * from programms where programms.id = ?',[$id])[0];
        $kunden = DB::select('SELECT * from kundes where sperre = 0 AND id not in (select kun_id from programmkundes where pro_id = ?) order by name asc', [$id]);
        return view('programm_edit')->with('var', [
                'programm' => $programm,
                'programm_edit' => $programm_edit,
                'kunden' => $kunden,
                'pro_id' => $id,
                'programmkunden' => $programmkunden
                ]);  
    }
        
    public function programm_artikel($id)
    {
        $artikel = Artikel::where('sperre', 0)->orderby('bezeichnung','ASC')->get();

        return view('programmartikelkunde')->with('var', [
            'artikel' => $artikel,
            'id' => $id
        ]);  
    }

    
    public function programm_artikel_kunde($id,$artikel)
    {
        $kunden = DB::select('  SELECT * FROM kundes WHERE kundes.id NOT IN  
                                    ( SELECT
                                        programmkundes.kun_id
                                    FROM
                                        programmkundeartikels
                                    JOIN programmkundes ON programmkundes.id = programmkundeartikels.prokun_id
                                    JOIN programms ON programms.id = programmkundes.pro_id
                                    WHERE
                                        programms.id = ? AND programmkundeartikels.art_id = ? )',[$id, $artikel]);

        $artikel = Artikel::find($artikel);

        return view('programmartikelkunde1')->with('var',[
            'kunden' => $kunden,
            'artikel' => $artikel,
            'id' => $id
        ]);
    }

    public function programm_artikel_kunde_store(Request $request)
    {


        foreach ($request->kunden as $kunde) {

            // checken ob ein Eintrag für den Kunden in diesm Programm bereits existiert
            $programmkunde_anzahl = Programmkunde::where([['pro_id', '=', $request->programm_id], ['kun_id', '=', $kunde]])->count();

            if ($programmkunde_anzahl == 0) {
                $programmkunde = new Programmkunde;
                $programmkunde->pro_id = $request->programm_id;
                $programmkunde->kun_id = $kunde;
                $programmkunde->save();

                $programmkunde_artikel = new Programmkundeartikel;
                $programmkunde_artikel->prokun_id = $programmkunde->id;
                $programmkunde_artikel->art_id = $request->artikel_id;
                $programmkunde_artikel->save();

            } elseif ($programmkunde_anzahl == 1) {

                $programmkunde = Programmkunde::where([['pro_id', '=', $request->programm_id], ['kun_id', '=', $kunde]])->get()[0];
                $programmkunde_artikel = new Programmkundeartikel;
                $programmkunde_artikel->prokun_id = $programmkunde->id;
                $programmkunde_artikel->art_id = $request->artikel_id;
                $programmkunde_artikel->save();

            } else {

                $kunde = Kunde::find($kunde)->name;
                return redirect()->back()->with('status', ['error' => "Der Kunde $kunde taucht mehrmals in dem Programm auf, da stimmt was nicht bitte checken!!!"]);

            }

        }

        return redirect()->back()->with('status', ['success' => "Artikel erforlgreich hinzugefügt"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programm  $programm
     * @return \Illuminate\Http\Response
     */
    public function edit(Programm $programm)
    {
        $artikel = DB::select('SELECT artikels.*, users.name from artikels join users on artikels.user_id = users.id WHERE artikels.sperre = 0 order by artikels.bezeichnung asc');
        $kunden = DB::select('SELECT * from kundes WHERE kundes.sperre = 0 order by name asc');
        $artikel_edit = DB::select('select * from artikels where artikels.id = ?',[$id])[0];
        return view('artikel')->with('var', [
                'artikel' => $artikel,
                'artikel_edit' => $artikel_edit,
                'kunden' => $kunden
                ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programm  $programm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ### To-Do Wenn man nur den Titel des Programms ändern möchte geht es nicht weil Überschneidung
        // $ueberschneidung_check = DB::select('   SELECT
        //     *
        //     FROM
        //         programms
        //     WHERE
        //         programms.von BETWEEN ? AND ? OR 
        //         programms.bis BETWEEN ? AND ? OR ? BETWEEN programms.von AND programms.bis', [$request->von, $request->bis, $request->von, $request->bis, $request->von]
        // );

        // if (sizeof($ueberschneidung_check) > 0) {
        //     return redirect()->back()->with('status', ['error' => 'Der von Ihnen gewählte Zeitraum überschneidet sich mit dem Programm: '.$ueberschneidung_check[0]->pro_name]);
        // }
        
        $programm = Programm::find($id);
        $programm->pro_name = $request->pro_name;
        $programm->von = $request->von;
        $programm->bis = $request->bis;

        try {
            $programm->save();
            return redirect('/programm')->with('status', ['success' => 'Programm '.$request->name.' erfolgreich aktualiesiert']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/programm')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. existiert der Artikel bereits.',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programm  $programm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programm $programm)
    {
        //
    }
}
