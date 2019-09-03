<?php
namespace App\CustomClass;

use Auth;
use App\Ggn;
use App\Artikel;
use App\ggnsartikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomClass\MySoap;
use Illuminate\Support\Facades\Storage;

class SoapRoutines
{
    function ItemInsert($ggn) {

        // Soap insert
        $soap = new MySoap;
        global $responsprop;
        $responsprop = $soap->bookmarkItemInsert($ggn);
        
        // wenn respons ok
        if ($responsprop->result == 'ok') {
            $ggn_db = new Ggn;
            $ggn_db->ggn = $ggn;
            $ggn_db->user_name = (Auth::check()) ? Auth::user()->name : 'PythonScript';
            $ggn_db->id = $responsprop->bookmarkItemId;
            
            $ggn_db->save();
            
            return true;

        } else {

            return false;

        }
    }
}


?>