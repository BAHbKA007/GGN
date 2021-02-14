<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->role == 1) {
                return redirect()->action('ZaehlungController@index');
            } else {
                return view('home')->with('var',[
                    'user' => Auth::user()->name
                ]);
            }

        } else {

            return redirect('login');

        }
    }
}
