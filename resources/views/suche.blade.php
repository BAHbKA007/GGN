@extends('layouts.app')

@php
    $land = ['AND' => 'ad','ARE' => 'ae','AFG' => 'af','ATG' => 'ag','AIA' => 'ai','ALB' => 'al','ARM' => 'am','AGO' => 'ao','ATA' => 'aq','ARG' => 'ar','ASM' => 'as','AUT' => 'at','AUS' => 'au','ABW' => 'aw','ALA' => 'ax','AZE' => 'az','BIH' => 'ba','BRB' => 'bb','BGD' => 'bd','BEL' => 'be','BFA' => 'bf','BGR' => 'bg','BHR' => 'bh','BDI' => 'bi','BEN' => 'bj','BLM' => 'bl','BMU' => 'bm','BRN' => 'bn','BOL' => 'bo','BES' => 'bq','BRA' => 'br','BHS' => 'bs','BTN' => 'bt','BVT' => 'bv','BWA' => 'bw','BLR' => 'by','BLZ' => 'bz','CAN' => 'ca','CCK' => 'cc','COD' => 'cd','CAF' => 'cf','COG' => 'cg','CHE' => 'ch','CIV' => 'ci','COK' => 'ck','CHL' => 'cl','CMR' => 'cm','CHN' => 'cn','COL' => 'co','CRI' => 'cr','CUB' => 'cu','CPV' => 'cv','CUW' => 'cw','CXR' => 'cx','CYP' => 'cy','CZE' => 'cz','DEU' => 'de','DJI' => 'dj','DNK' => 'dk','DMA' => 'dm','DOM' => 'do','DZA' => 'dz','ECU' => 'ec','EST' => 'ee','EGY' => 'eg','ESH' => 'eh','ERI' => 'er','ESP' => 'es','ETH' => 'et','FIN' => 'fi','FJI' => 'fj','FLK' => 'fk','FSM' => 'fm','FRO' => 'fo','FRA' => 'fr','GAB' => 'ga','GBR' => 'gb','GRD' => 'gd','GEO' => 'ge','GUF' => 'gf','GGY' => 'gg','GHA' => 'gh','GIB' => 'gi','GRL' => 'gl','GMB' => 'gm','GIN' => 'gn','GLP' => 'gp','GNQ' => 'gq','GRC' => 'gr','SGS' => 'gs','GTM' => 'gt','GUM' => 'gu','GNB' => 'gw','GUY' => 'gy','HKG' => 'hk','HMD' => 'hm','HND' => 'hn','HRV' => 'hr','HTI' => 'ht','HUN' => 'hu','IDN' => 'id','IRL' => 'ie','ISR' => 'il','IMN' => 'im','IND' => 'in','IOT' => 'io','IRQ' => 'iq','IRN' => 'ir','ISL' => 'is','ITA' => 'it','JEY' => 'je','JAM' => 'jm','JOR' => 'jo','JPN' => 'jp','KEN' => 'ke','KGZ' => 'kg','KHM' => 'kh','KIR' => 'ki','COM' => 'km','KNA' => 'kn','PRK' => 'kp','KOR' => 'kr','KWT' => 'kw','CYM' => 'ky','KAZ' => 'kz','LAO' => 'la','LBN' => 'lb','LCA' => 'lc','LIE' => 'li','LKA' => 'lk','LBR' => 'lr','LSO' => 'ls','LTU' => 'lt','LUX' => 'lu','LVA' => 'lv','LBY' => 'ly','MAR' => 'ma','MCO' => 'mc','MDA' => 'md','MNE' => 'me','MAF' => 'mf','MDG' => 'mg','MHL' => 'mh','MKD' => 'mk','MLI' => 'ml','MMR' => 'mm','MNG' => 'mn','MAC' => 'mo','MNP' => 'mp','MTQ' => 'mq','MRT' => 'mr','MSR' => 'ms','MLT' => 'mt','MUS' => 'mu','MDV' => 'mv','MWI' => 'mw','MEX' => 'mx','MYS' => 'my','MOZ' => 'mz','NAM' => 'na','NCL' => 'nc','NER' => 'ne','NFK' => 'nf','NGA' => 'ng','NIC' => 'ni','NLD' => 'nl','NOR' => 'no','NPL' => 'np','NRU' => 'nr','NIU' => 'nu','NZL' => 'nz','OMN' => 'om','PAN' => 'pa','PER' => 'pe','PYF' => 'pf','PNG' => 'pg','PHL' => 'ph','PAK' => 'pk','POL' => 'pl','SPM' => 'pm','PCN' => 'pn','PRI' => 'pr','PSE' => 'ps','PRT' => 'pt','PLW' => 'pw','PRY' => 'py','QAT' => 'qa','REU' => 're','ROU' => 'ro','SRB' => 'rs','RUS' => 'ru','RWA' => 'rw','SAU' => 'sa','SLB' => 'sb','SYC' => 'sc','SDN' => 'sd','SWE' => 'se','SGP' => 'sg','SHN' => 'sh','SVN' => 'si','SJM' => 'sj','SVK' => 'sk','SLE' => 'sl','SMR' => 'sm','SEN' => 'sn','SOM' => 'so','SUR' => 'sr','SSD' => 'ss','STP' => 'st','SLV' => 'sv','SXM' => 'sx','SYR' => 'sy','SWZ' => 'sz','TCA' => 'tc','TCD' => 'td','ATF' => 'tf','TGO' => 'tg','THA' => 'th','TJK' => 'tj','TKL' => 'tk','TLS' => 'tl','TKM' => 'tm','TUN' => 'tn','TON' => 'to','TUR' => 'tr','TTO' => 'tt','TUV' => 'tv','TWN' => 'tw','TZA' => 'tz','UKR' => 'ua','UGA' => 'ug','UMI' => 'um','USA' => 'us','URY' => 'uy','UZB' => 'uz','VAT' => 'va','VCT' => 'vc','VEN' => 've','VGB' => 'vg','VIR' => 'vi','VNM' => 'vn','VUT' => 'vu','WLF' => 'wf','WSM' => 'ws','YEM' => 'ye','MYT' => 'yt','ZAF' => 'za','ZMB' => 'zm','ZWE' => 'zw'];
@endphp

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card" style="margin-bottom:20px">
                
                <div class="card-body">
                    <form method="POST" action="/suche">
                        @csrf

                        <div class="form-group">
                            <input id="focus" type="text" class="form-control form-control-sm" name="suche" placeholder='GGN oder Namen oder nur Teile mit Leerzeichen dazwischen eingeben z.B. "40 290" ...' required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">suchen</button>
                    </form>
                </div>
                
            </div>
            @if (isset($var['positionen']))
                <ul class="list-group">

                    @foreach ($var['positionen'] as $item)

                        <li class="list-group-item">
            
                            @php
                                if( $item->grasp_status == NULL || $item->artikel_datum == NULL){
                                    $farbe = 'warning';
                                } elseif    ( 
                                                (isset($item->grasp_valid_to_current)) 
                                                && 
                                                ( strtotime($item->grasp_valid_to_current) < time() && strtotime($item->grasp_valid_to_next) < time() ) 
                                                || 
                                                ( ($item->artikel_datum != NULL && strtotime($item->artikel_datum) < time()) && ($item->artikel_datum_next != NULL && strtotime($item->artikel_datum_next) < time()) )
                                            ) 
                                    {
                                    $farbe = 'danger';
            
                                } else {
                                    $farbe = 'success';
                                }
                            @endphp

                            <button type="button" data-ggn="{{$item->ggn}}" class="btn btn-light copy float-left" style="margin-right: 10px"><i class="material-icons" style="font-size:16px;">file_copy</i></button>
                            <button class="btn btn-{{$farbe}}" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapse">
                                @if (strlen ($item->country) == 3) <span style="font-size:20px" class="flag-icon flag-icon-{{$land[$item->country]}}"></span> @endif {{$item->ggn}}
                            </button>
                            <span style="margin-left:10px">
                                 {{$item->erzeuger}} 
                                 | {{$item->country}}
                                 | {{$item->company_type}} 
                                 | GRASP: @if (isset($item->grasp_status)) {{$item->grasp_status}} 
                                 @if (isset($item->grasp_valid_to_current))
                                 bis {{strftime("%d.%m.%Y", strtotime($item->grasp_valid_to_current))}}
                                 @endif  @else NEIN @endif
                                 @if (isset($item->groupggn)) | Gruppe: {{$item->groupggn}} @endif 
                            </span>
                            <div class="collapse" id="collapse{{$item->id}}">
                                <table class="table table-bordered table-sm" style="margin-top: 16px;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Artikel</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">aktueller Zyklus</th>
                                            <th scope="col">nächster Zyklus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->artikel as $artikel)
                                            <tr @if ( ($artikel->valid_to_current != NULL && strtotime($artikel->valid_to_current) < time()) && ( $artikel->valid_to_next != NULL && strtotime($artikel->valid_to_next) < time() ) ) style="background-color:#FF6347" @endif>
                                                <td>{{$artikel->product_name}}</td>
                                                <td>{{$artikel->product_status}}</td>
                                                <td>@if ($artikel->valid_to_current != NULL) {{strftime("%d.%m.%Y", strtotime($artikel->valid_to_current))}} @endif</td>
                                                <td>@if ($artikel->valid_to_next != NULL) {{strftime("%d.%m.%Y", strtotime($artikel->valid_to_next))}} @endif</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<script>
    $( ".copy" ).click(function() {
        var text = $(this).data("ggn");
        navigator.clipboard.writeText(text).then(function() {
            console.log('Async: Copying to clipboard was successful! ' + text);
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    });
</script>
@endsection
