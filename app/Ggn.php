<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ggn extends Model
{
    public $incrementing = false;

    public function artikels()
    {
        return $this->hasMany('App\Artikel');
    }

    public function soap_artikels()
    {
        return $this->hasMany('App\SoapArtikel');
    }
}
