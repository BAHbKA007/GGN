<?php

namespace App\Http\Controllers;

use App\Kunde;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class KundeController extends Controller
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
        $kunden = DB::select('select kundes.* from kundes order by kundes.name asc');

        return view('kunden')->with('var', [
                'kunden' => $kunden
                ]);    }

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
        $kunde = new Kunde;
        $kunde->name = $request->name;
        $kunde->user_id = Auth::user()->id;

        try {
            $kunde->save();
            return redirect('/kunden')->with('status', ['success' => 'Kunde <strong>'.$request->name.'</strong> erfolgreich hinzugefügt']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/kunden')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. Existiert der Kunde bereits.',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kunde  $kunde
     * @return \Illuminate\Http\Response
     */
    public function show(Kunde $kunde)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kunde  $kunde
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kunden = DB::select('select * from kundes order by kundes.name asc');
        $kunden_edit = DB::select('select * from kundes where kundes.id = ?',[$id])[0];
        return view('kunden')->with('var', [
                'kunden' => $kunden,
                'kunden_edit' => $kunden_edit
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kunde  $kunde
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kunde = Kunde::find($id);
        $kunde->name = $request->name;

        try {
            $kunde->save();
            return redirect('/kunden')->with('status', ['success' => 'Kunde <strong>'.$request->name.'</strong> erfolgreich aktualiesiert']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/kunden')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. Existiert der Kunde bereits.',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kunde  $kunde
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kunde::destroy($id);
    }
}