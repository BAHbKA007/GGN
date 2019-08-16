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
}
