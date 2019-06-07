<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ggnsartikel;
use App\Ggn;
use Auth;

class ggnsartikelController extends Controller
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
    public function index($art_id)
    {
        $artikel = DB::select('SELECT * FROM artikels WHERE artikels.id = ?',[$art_id])[0];
        $ggns = DB::select('SELECT * FROM ggns WHERE ggn NOT IN (SELECT ggn FROM ggnsartikels WHERE ggnsartikels.artikel_id =?)',[$art_id]);
        $ggnsartikel = DB::select('SELECT * FROM ggnsartikels JOIN ggns ON ggns.ggn = ggnsartikels.ggn WHERE artikel_id = ?',[$art_id]);
        return view('artikelggns')->with('var', [
            'ggns' => $ggns,
            'art_id' => $art_id,
            'artikel' => $artikel,
            'ggnsartikel' => $ggnsartikel
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
    public function store(Request $request, $art_id)
    {
        $ggn = Ggn::find($request->ggn);

        if ($ggn == NULL) {
            return redirect()->back()->with('status', ['error' => 'Die von Ihnen eingegebene GGN: '.$request->ggn.' existiert nicht in der Datenbank']);
        }

        $ggnsartikel = new ggnsartikel;
        $ggnsartikel->ggn = $request->ggn;
        $ggnsartikel->artikel_id = $art_id;
        $ggnsartikel->user_id = Auth::user()->id;
        $ggnsartikel->save();

        return redirect()->back()->with('status', ['success' => 'GGN: '.$request->ggn.' erfolgreich hinzugefügt']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
