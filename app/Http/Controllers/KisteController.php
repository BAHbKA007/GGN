<?php

namespace App\Http\Controllers;

use App\Kiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class KisteController extends Controller
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

        $kiste = Kiste::all();

        return view('kiste')->with('var', [
                'kiste' => $kiste
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
        $kiste = new Kiste;
        $kiste->bezeichnung = $request->bezeichnung;
        $kiste->ArtikelNummer = $request->ArtikelNummer;
        $kiste->save();

        return back()->with('status', ['success' => 'Kiste <strong>'.$request->bezeichnung.'</strong> erfolgreich hinzugefügt']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kiste  $kiste
     * @return \Illuminate\Http\Response
     */
    public function show(kiste $kiste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kiste  $kiste
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kiste = Kiste::all();
        $kiste_edit = Kiste::find($id);

        return view('kiste')->with('var', [
                'kiste' => $kiste,
                'kiste_edit' => $kiste_edit
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kiste  $kiste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kiste = Kiste::find($id);
        $kiste->bezeichnung = $request->bezeichnung;
        $kiste->ArtikelNummer = $request->ArtikelNummer;

        try {
            $kiste->save();
            return redirect('/kiste')->with('status', ['success' => 'kiste <strong>'.$request->bezeichnung.'</strong> erfolgreich aktualiesiert']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/kiste')->with('status', [
                'error' => 'Hat leider nicht geklappt, Kistebezeichnung oder Artikelnummer wurde bereits verwendet. Exsitiert die Kiste schon?',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kiste  $kiste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kiste = kiste::find($request->id);
        $kiste->sperre = ($kiste->sperre == 1) ? 0 : 1;
        $kiste->save();

        return back()->with('status', ['success' => 'kiste <strong>'.$kiste->bezeichnung.'</strong> erfolgreich gesperrt']);
    }
}
