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

class ZaehlungpositionExport implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithHeadings
{
    public function headings(): array
    {
        return [
            'Aldi Gesellschaft',
            'Artikel',
            'Tag',
            'Menge',
            'GGN',
            'Gruppen GGN',
            'Erzeuger',
            'Land',
            'Typ',
            'GRASP Status',
            'aktueller Zyklus',
            'nächster Zyklus',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    
        $articles = DB::table('zaehlungpositions')
        ->select('kundes.name as AldiGesellschaft', 
                    'artikels.bezeichnung as Artikel', 
                    DB::raw('DATE_FORMAT(zaehlungs.created_at, "%d.%m.%Y") as Tag'), 
                    'zaehlungpositions.menge as Menge', 
                    'zaehlungpositions.ggn as GGN',
                    'ggns.groupggn as Gruppen GGN',
                    'ggns.erzeuger as Erzeuger',
                    'ggns.country as Land',
                    'ggns.company_type as Typ',
                    'ggns.grasp_status as Status',
                    'ggns.grasp_valid_to_current',
                    'ggns.grasp_valid_to_next',
                )
        ->join('kundes', 'zaehlungpositions.kunde_id', '=', 'kundes.id')
        ->join('artikels', 'artikels.id', '=', 'zaehlungpositions.art_id')
        ->join('zaehlungs', 'zaehlungs.id', '=', 'zaehlungpositions.zaehlung_id')
        ->join('ggns', 'zaehlungpositions.ggn', '=', 'ggns.ggn')
        ->where('zaehlungs.id', '=', $this->id)
        ->orderBy('AldiGesellschaft', 'ASC')

        ->get();
        
        return $articles;
    }
}
