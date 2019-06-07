<?php

namespace App\Http\Controllers;

use App\Dienstleistung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class DienstleistungController extends Controller
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
        $dienstleistung = DB::select('select * from dienstleistungs order by dienstleistungs.name asc');

        return view('dienstleistung')->with('var', [
                'dienstleistung' => $dienstleistung
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
        $dienstleistung = new Dienstleistung;
        $dienstleistung->name = $request->name;
        $dienstleistung->user_id = Auth::user()->id;

        try {
            $dienstleistung->save();
            return redirect('/dienstleistung')->with('status', ['success' => 'Dienstleistung '.$request->bezeichnung.' erfolgreich hinzugefügt']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/dienstleistung')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. existiert die dienstleistung bereits.',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dienstleistung  $dienstleistung
     * @return \Illuminate\Http\Response
     */
    public function show(Dienstleistung $dienstleistung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dienstleistung  $dienstleistung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dienstleistung = DB::select('select * from dienstleistungs order by dienstleistungs.name asc');
        $dienstleistung_edit = DB::select('select * from dienstleistungs where dienstleistungs.id = ?',[$id])[0];
        return view('dienstleistung')->with('var', [
                'dienstleistung' => $dienstleistung,
                'dienstleistung_edit' => $dienstleistung_edit
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dienstleistung  $dienstleistung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dienstleistung = Dienstleistung::find($id);
        $dienstleistung->name = $request->name;

        try {
            $dienstleistung->save();
            return redirect('/dienstleistung')->with('status', ['success' => 'Dienstleistung '.$request->name.' erfolgreich aktualiesiert']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/dienstleistung')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. existiert die Dienstleistung bereits.',
                'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dienstleistung  $dienstleistung
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dienstleistung::destroy($id);
    }
}
