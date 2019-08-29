<?php

namespace App\Exports;

use App\Zaehlungposition;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ZaehlungpositionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
