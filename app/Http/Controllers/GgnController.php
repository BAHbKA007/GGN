<?php

namespace App\Http\Controllers;
use Auth;
use App\Ggn;
use App\Artikel;
use App\ggnsartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GgnController extends Controller
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

    public function index()
    {
        $ggns = DB::select('select * from ggns order by ggn asc');

        return view('ggns')->with('var', [
            'ggns' => $ggns
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ggn = new Ggn;
        $ggn->ggn = $request->ggn;
        $ggn->erzeuger = $request->erzeuger;
        $ggn->user_id = Auth::user()->id;
        
        if (Ggn::find($request->ggn) == NULL) {
            $ggn->save();
            return redirect('/ggn')->with('status', ['success' => 'GGN '.$request->ggn.' vom Erzeuger '.$request->erzeuger.' erfolgreich hinzugefügt']);
        } else {

            return redirect('/ggn')->with('status', [
                'error' => 'Hat leider nicht geklappt, die GGN existiert bereits.'
                ]);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ggns = DB::select('select * from ggns order by ggn asc');
        $ggn_edit =  DB::select('select * from ggns where ggn = ?',[$id])[0];

        return view('ggns')->with('var', [
            'ggns' => $ggns,
            'ggn_edit' => $ggn_edit
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
        $ggn = Ggn::find($id);
        $ggn->ggn = $request->ggn;
        $ggn->erzeuger = $request->erzeuger;

        try {
            $ggn->save();
            return redirect('/ggn')->with('status', ['success' => 'GGN '.$request->ggn.' erfolgreich aktualiesiert']);
        }
            //catch exception
            catch(Exception $e) {
            return redirect('/ggn')->with('status', [
                'error' => 'Hat leider nicht geklappt, evtl. existiert die GGN bereits.',
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
        Ggn::destroy($id);
    }
}
