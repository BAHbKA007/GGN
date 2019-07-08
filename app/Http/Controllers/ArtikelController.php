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
        $artikel = DB::select('SELECT artikels.*, (SELECT COUNT(*) FROM ggnsartikels WHERE ggnsartikels.artikel_id = artikels.id) AS art_count, users.name from artikels join users on artikels.user_id = users.id order by artikels.bezeichnung asc');

        return view('artikel')->with('var', [
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
        $artikel = new Artikel;
        $artikel->bezeichnung = $request->bezeichnung;
        $artikel->user_id = Auth::user()->id;

        try {
            $artikel->save();
            return redirect('/artikel')->with('status', ['success' => 'Artikel <strong>'.$request->bezeichnung.'</strong> erfolgreich hinzugefügt']);
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
        return view('artikel')->with('var', [
                'artikel' => $artikel,
                'artikel_edit' => $artikel_edit
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
    public function destroy($id)
    {
        Artikel::destroy($id);
    }
}
