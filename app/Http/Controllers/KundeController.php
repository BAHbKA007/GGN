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
        $kunden = DB::select('SELECT * FROM kundes WHERE kundes.sperre = 0 ORDER BY kundes.name ASC');
        $gesperrte = DB::select('SELECT * FROM kundes WHERE kundes.sperre = 1 ORDER BY kundes.name ASC');

        return view('kunden')->with('var', [
                'kunden' => $kunden,
                'gesperrte' => $gesperrte
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
        $kunde = new Kunde;
        $kunde->name = $request->name;
        $kunde->user_id = Auth::user()->id;

        // prüfen ob Kundebezeichnung bereits existiert
        if ( Kunde::where('name', $request->name)->count() > 0 ) {

            // auf Sperre prüfen
            if ( Kunde::where('name', $request->name)->first()->sperre == 0 ) {

                // wenn nicht gespert User zurückschicken
                return back()->with('status', ['error' => 'Kunde <strong>'.$request->name.'</strong> ist bereits vorhanden']);

            } else {
                
                // wenn gesperrt, Sperre wegmachen
                $kunde = Kunde::where('name', $request->name)->first();
                $kunde->sperre = 0;
                $kunde->save();
                return back()->with('status', ['success' => 'Kunde <strong>'.$request->name.'</strong> erfolgreich entsperrt']);

            }
        } else {
            
            // wenn Kunde neu
            $kunde->save();
            return back()->with('status', ['success' => 'Kunde <strong>'.$request->name.'</strong> erfolgreich hinzugefügt']);
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
        $kunden = DB::select('SELECT * FROM kundes WHERE kundes.sperre = 0 ORDER BY kundes.name ASC');
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
    public function destroy(Request $request)
    {
        $kunde = Kunde::find($request->id);
        $kunde->sperre = ($kunde->sperre == 1) ? 0 : 1;
        $kunde->user_id = Auth::user()->id;
        $kunde->save();

        return back()->with('status', ['success' => 'Kunde <strong>'.$kunde->name.'</strong> erfolgreich gesperrt']);
    }
}