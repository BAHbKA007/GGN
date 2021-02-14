<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function Error500()
    {
        return view('errors.500');
    }

    public function Error419()
    {
        return view('errors.419');
    }
}
