<?php

namespace App\Exports;

use App\Zaehlungposition;
use App\User;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ZaehlungpositionExport implements FromCollection, ShouldAutoSize, WithColumnFormatting
{
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    
        $articles = DB::table('zaehlungpositions')
        ->select('kundes.name as AldiGesellschaft', 'artikels.bezeichnung as Artikel', DB::raw('DATE_FORMAT(zaehlungs.created_at, "%d.%m.%Y") as Tag'), 'zaehlungpositions.menge as Menge', 'zaehlungpositions.ggn as GGN')
        ->join('kundes', 'zaehlungpositions.kunde_id', '=', 'kundes.id')
        ->join('artikels', 'artikels.id', '=', 'zaehlungpositions.id')
        ->join('zaehlungs', 'zaehlungs.id', '=', 'zaehlungpositions.zaehlung_id')
        ->where('zaehlungs.id', $this->id)
        ->orderBy('AldiGesellschaft', 'ASC')

        ->get();
        
        return $articles;
    }
}
