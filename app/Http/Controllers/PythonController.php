<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ggn;
use App;


class PythonController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $ggn = DB::select('SELECT count(*) AS zahl FROM ggns WHERE created_at = updated_at')[0]->zahl;
        return $ggn;
    }
}
