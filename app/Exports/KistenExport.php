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
            'Leergutart'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_TEXT
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kisten = DB::select(
            "SELECT 
                kundes.name,
                SUM(zaehlungpositions.menge),
                kistes.bezeichnung
            FROM `zaehlungpositions`
            JOIN kundes ON kundes.id = zaehlungpositions.kunde_id
            JOIN kistes ON kistes.id = zaehlungpositions.kiste_id
            WHERE zaehlungpositions.zaehlung_id = $this->id
            GROUP BY kundes.name, kistes.bezeichnung
            ORDER BY 1" );
        
        return collect( $kisten );
    }
}
