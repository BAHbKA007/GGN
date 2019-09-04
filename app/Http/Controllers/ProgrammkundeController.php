<?php

namespace App\Http\Controllers;

use App\Programmkunde;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgrammkundeController extends Controller
{
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

        foreach ($request->kunden as $kunde) {
            $i++;
            $programmkunde = new Programmkunde;
            $programmkunde->pro_id = $request->pro_id;
            $programmkunde->kun_id = $kunde;
            $programmkunde->save();
        }

        return redirect()->back()->with('status', ['success' => $i.' Kunden hinzugefügt']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programmkunde  $programmkunde
     * @return \Illuminate\Http\Response
     */
    public function show(Programmkunde $programmkunde)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programmkunde  $programmkunde
     * @return \Illuminate\Http\Response
     */
    public function edit(Programmkunde $programmkunde)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programmkunde  $programmkunde
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programmkunde $programmkunde)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programmkunde  $programmkunde
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Programmkunde::destroy($request->id);
        return redirect()->back()->with('status', ['success' => 'Kunde erfolgreich entfernt.']);
    }
}
