<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ggnsartikel extends Model
{
    public function artikels()
    {
        return $this->belongsTo('App\Artikel');
    }
}
