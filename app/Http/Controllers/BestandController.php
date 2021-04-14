<?php

namespace App\Http\Controllers;

use App\Bestand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BestandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bestand');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bestand  $bestand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $bestand = DB::select("SELECT 
                                    DISTINCT artikels.* 
                                    FROM programmkundeartikels 
                                    JOIN programmkundes ON programmkundes.id = programmkundeartikels.prokun_id 
                                    JOIN programms ON programms.id = programmkundes.pro_id 
                                    JOIN artikels ON artikels.id = programmkundeartikels.art_id 
                                    WHERE '2021-04-14' BETWEEN programms.von AND programms.bis ORDER BY programmkundeartikels.id DESC", [$request->datum]);

        return view('bestand')->with('var', [
                        'bestand' => $bestand
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bestand  $bestand
     * @return \Illuminate\Http\Response
     */
    public function edit(Bestand $bestand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bestand  $bestand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bestand $bestand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bestand  $bestand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bestand $bestand)
    {
        //
    }
}
