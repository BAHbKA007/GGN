<?php

namespace App\Http\Controllers;

use Auth;
use App\Ggn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MySoap;
use Illuminate\Support\Facades\Storage;

class Synch extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Soap Query
        $soap = new MySoap;
        $responsprop = $soap->getBookmark();

        return var_dump($responsprop->bookmarkItemList);
        
        // wenn respons ok
        if ($responsprop->result == 'ok') {
            return back()->with('status', ['success' => 'Erfolgreich synchronisiert']);
        } else {
            return back()->with('status', [
                'error' => 'Error'
            ]);
        }
    }
}
