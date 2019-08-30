<?php

namespace App\Exports;

use App\Zaehlungposition;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ZaehlungpositionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $articles = DB::table('zaehlungpositions')
        ->select('kundes.name as AldiGesellschaft', 'artikels.bezeichnung as Artikel', 'zaehlungs.created_at as Tag', 'zaehlungpositions.menge as Menge', 'zaehlungpositions.ggn as GGN')
        ->join('kundes', 'zaehlungpositions.kunde_id', '=', 'kundes.id')
        ->join('artikels', 'artikels.id', '=', 'zaehlungpositions.id')
        ->join('zaehlungs', 'zaehlungs.id', '=', 'zaehlungpositions.zaehlung_id')
        ->where('zaehlungs.id', $this->id)
        ->orderBy('AldiGesellschaft', 'ASC')

        ->get();
        
        return $articles;
    }
}
