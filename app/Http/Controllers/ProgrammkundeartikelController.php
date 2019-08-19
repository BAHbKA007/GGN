<?php

namespace App\Http\Controllers;

use App\Programmkundeartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgrammkundeartikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $i = 0;
        foreach ($request->artikel as $artikel) {
            $i++;
            $programmkundeartikel = new Programmkundeartikel;
            $programmkundeartikel->art_id = $artikel;
            $programmkundeartikel->prokun_id = $request->prokun_id;
            $programmkundeartikel->save();
        }

        return redirect()->back()->with('status', ['success' => $i.' Artikel hinzugefügt']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programmkundeartikel  $programmkundeartikel
     * @return \Illuminate\Http\Response
     */
    public function show($pro_id,$id)
    {
        $programm = DB::select('SELECT * FROM programms WHERE programms.id = ?',[$pro_id])[0];
        $kunde = DB::select('SELECT kundes.name FROM programmkundes JOIN kundes ON programmkundes.kun_id = kundes.id WHERE programmkundes.id = ?',[$id])[0];
        $artikel = DB::select('SELECT * FROM artikels WHERE artikels.id NOT IN (select art_id from programmkundeartikels where prokun_id = ?) AND artikels.sperre = 0 ORDER BY bezeichnung ASC',[$id]);
        $programmkundeartikel = DB::select('SELECT programmkundeartikels.*, artikels.bezeichnung, artikels.id AS art_id, (SELECT COUNT(*) FROM ggnsartikels WHERE ggnsartikels.artikel_id = artikels.id) AS art_count from programmkundeartikels join artikels on artikels.id = programmkundeartikels.art_id where prokun_id = ?',[$id]);
        
        return view('programmkundeartikel')->with('var', [
                'artikel' => $artikel,
                'programmkundeartikel' => $programmkundeartikel,
                'kunde' => $kunde,
                'id' => $id,
                'programm' => $programm
            ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programmkundeartikel  $programmkundeartikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Programmkundeartikel $programmkundeartikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programmkundeartikel  $programmkundeartikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programmkundeartikel $programmkundeartikel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programmkundeartikel  $programmkundeartikel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Programmkundeartikel::destroy($id);
    }
}
