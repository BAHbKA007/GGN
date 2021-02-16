<?php

namespace App\Exports;

use App\Zaehlungposition;
use App\User;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KistenExport implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithHeadings
{
    public function headings(): array
    {
        return [
            'Aldi Lager',
            'Menge',
            'Artikel',
            'Leergutart'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kisten = DB::select(
            "SELECT 
                kundes.name AS Kunde,
                SUM(zaehlungpositions.menge) AS Menge,
                artikels.bezeichnung AS Artikel,
                kistes.bezeichnung AS Kiste
            FROM `zaehlungpositions`
            JOIN kundes ON kundes.id = zaehlungpositions.kunde_id
            JOIN kistes ON kistes.id = zaehlungpositions.kiste_id
            JOIN artikels ON artikels.id = zaehlungpositions.art_id
            WHERE zaehlungpositions.zaehlung_id = $this->id
            GROUP BY Kunde, Artikel, Kiste
            ORDER BY 1" );
        
        return collect( $kisten );
    }
}
