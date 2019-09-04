<?php

namespace App\Http\Controllers;

use App\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class ArtikelController extends Controller
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

        $artikel = DB::select('SELECT artikels.*, (SELECT COUNT(*) FROM ggnsartikels WHERE ggnsartikels.artikel_id = artikels.id) AS art_count, users.name FROM artikels JOIN users ON artikels.user_id = users.id WHERE sperre = 0 ORDER BY artikels.bezeichnung ASC');
        $artikel_gesperrt = DB::select('SELECT * FROM artikels WHERE sperre = 1 ORDER BY artikels.bezeichnung ASC');

        return view('artikel')->with('var', [
                'artikel' => $artikel,
                'artikel_gesperrt' => $artikel_gesperrt
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
        $artikel = new Artikel;
        $artikel->bezeichnung = $request->bezeichnung;
        $artikel->user_id = Auth::user()->id;

        // prüfen ob Artikelbezeichnung bereits existiert
        if ( Artikel::where('bezeichnung', $request->bezeichnung)->count() > 0 ) {

            // auf Sperre prüfen
            if ( Artikel::where('bezeichnung', $request->bezeichnung)->first()->sperre == 0 ) {

                // wenn nicht gespert User zurückschicken
                return back()->with('status', ['error' => 'Artikel <strong>'.$request->bezeichnung.'</strong> ist bereits vorhanden']);

            } else {
                
                // wenn gesperrt, Sperre wegmachen
                $artikel = Artikel::where('bezeichnung', $request->bezeichnung)->first();
                $artikel->sperre = 0;
                $artikel->save();
                return back()->with('status', ['success' => 'Artikel <strong>'.$request->bezeichnung.'</strong> erfolgreich entsperrt']);

            }
        } else {
            
            // wenn Artikel neu
            $artikel->save();
            return back()->with('status', ['success' => 'Artikel <strong>'.$request->bezeichnung.'</strong> erfolgreich hinzugefügt']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = DB::select('SELECT artikels.*, (SELECT COUNT(*) FROM ggnsartikels WHERE ggnsartikels.artikel_id = artikels.id) AS art_count, users.name from artikels join users on artikels.user_id = users.id order by artikels.bezeichnung asc');
        $artikel_edit = DB::select('select * from artikels where artikels.id = ?',[$id])[0];
        $artikel_gesperrt = DB::select('SELECT * FROM artikels WHERE sperre = 1 ORDER BY artikels.bezeichnung ASC');

        return view('artikel')->with('var', [
                'artikel' => $artikel,
                'artikel_edit' => $artikel_edit,
                'artikel_gesperrt' => $artikel_gesperrt
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
        $artikel = Artikel::find($id);
        $artikel->bezeichnung = $request->bezeichnung;

        try {
            $artikel->save();
            return redirect('/artikel')->with('status', ['success' => 'Artikel <strong>'.$request->bezeichnung.'</strong> erfolgreich aktualiesiert']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/artikel')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. existiert der Artikel bereits.',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $artikel = Artikel::find($request->id);
        $artikel->sperre = ($artikel->sperre == 1) ? 0 : 1;
        $artikel->save();

        return back()->with('status', ['success' => 'Artikel <strong>'.$artikel->bezeichnung.'</strong> erfolgreich gesperrt']);
    }
}
