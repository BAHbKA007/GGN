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
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // SELECT
        // kundes.name AS AldiGesellschaft,
        // artikels.bezeichnung AS Artikel,
        // DATE_FORMAT(zaehlungs.created_at,"%d.%m.%Y") AS Tag,
        // zaehlungpositions.menge as Menge,
        // zaehlungpositions.ggn as GGN,
        // ggns.groupggn as 'Gruppen GGN',
        // ggns.erzeuger as Erzeuger,
        // ggns.country as Land,
        // ggns.company_type as Typ,
        // ggns.grasp_status as Status,
        // DATE_FORMAT(ggns.grasp_valid_to_current, "%d.%m.%Y") as Tag,
        // DATE_FORMAT(ggns.grasp_valid_to_next, "%d.%m.%Y") as Tag
        // FROM zaehlungpositions
        // JOIN kundes ON zaehlungpositions.kunde_id = kundes.id
        // JOIN artikels ON artikels.id = zaehlungpositions.art_id
        // JOIN zaehlungs ON zaehlungs.id = zaehlungpositions.zaehlung_id
        // JOIN ggns ON zaehlungpositions.ggn = ggns.ggn
        // WHERE zaehlungs.id = 1
        // ORDER BY 1 ASC
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
                    DB::raw('DATE_FORMAT(ggns.grasp_valid_to_current, "%d.%m.%Y") as CurrentTag'),
                    DB::raw('DATE_FORMAT(ggns.grasp_valid_to_next, "%d.%m.%Y") as NextTag')
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
