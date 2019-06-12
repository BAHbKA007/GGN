<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    public function ggns()
    {
        return $this->belongsToMany('App\Ggn');
    }
}