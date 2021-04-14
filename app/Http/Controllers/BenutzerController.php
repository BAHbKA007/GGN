<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BenutzerController extends Controller
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
        $benutzer = DB::select('SELECT users.*, roles.name AS rolesname FROM users JOIN roles ON users.role = roles.id WHERE users.sperre = 0');
        $roles = DB::select('SELECT * from roles');

        return view('benutzer')->with('var', [
                'benutzer' => $benutzer,
                'roles' => $roles
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

        $benutzer = new User;
        $benutzer->name = $request->name;
        $benutzer->email = $request->email;
        $benutzer->password = Hash::make($request->password);
        $benutzer->role = $request->role;
        $benutzer->bestand = $request->is_bestand;
        $benutzer->save();
        return back()->with('status', ['success' => 'Benutzer erfolgreich hinzugefügt']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Benutzer  $benutzer
     * @return \Illuminate\Http\Response
     */
    public function show(User $benutzer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $benutzer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benutzer = DB::select('SELECT users.*, roles.name AS rolesname FROM users JOIN roles ON users.role = roles.id WHERE users.sperre = 0');
        $roles = DB::select('SELECT * FROM roles');

        $user = DB::select('SELECT users.*, roles.name AS rolesname, roles.id AS rolesid FROM users JOIN roles ON users.role = roles.id WHERE users.id = ?',[$id])[0];
        return view('benutzer')->with('var', [
            'benutzer' => $benutzer,
            'roles' => $roles,
            'edit_benutzer' => $user
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Benutzer  $benutzer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password != NULL) { $user->password = Hash::make($request->password); };
        (isset($request->is_bestand)) ? $user->bestand = 1 : $user->bestand = 0;
        $user->save();
        return redirect('/benutzer')->with('status', ['success' => 'Benutzer erfolgreich aktualiesiert']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Benutzer  $benutzer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->sperre = ($user->sperre == 1) ? 0 : 1;
        $user->save();

        return back()->with('status', ['success' => 'Benutzer <strong>'.$user->name.'</strong> erfolgreich gesperrt']);
    }
}
