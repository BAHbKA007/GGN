@extends('layouts.app')

@php
    $land = ['AND' => 'ad','ARE' => 'ae','AFG' => 'af','ATG' => 'ag','AIA' => 'ai','ALB' => 'al','ARM' => 'am','AGO' => 'ao','ATA' => 'aq','ARG' => 'ar','ASM' => 'as','AUT' => 'at','AUS' => 'au','ABW' => 'aw','ALA' => 'ax','AZE' => 'az','BIH' => 'ba','BRB' => 'bb','BGD' => 'bd','BEL' => 'be','BFA' => 'bf','BGR' => 'bg','BHR' => 'bh','BDI' => 'bi','BEN' => 'bj','BLM' => 'bl','BMU' => 'bm','BRN' => 'bn','BOL' => 'bo','BES' => 'bq','BRA' => 'br','BHS' => 'bs','BTN' => 'bt','BVT' => 'bv','BWA' => 'bw','BLR' => 'by','BLZ' => 'bz','CAN' => 'ca','CCK' => 'cc','COD' => 'cd','CAF' => 'cf','COG' => 'cg','CHE' => 'ch','CIV' => 'ci','COK' => 'ck','CHL' => 'cl','CMR' => 'cm','CHN' => 'cn','COL' => 'co','CRI' => 'cr','CUB' => 'cu','CPV' => 'cv','CUW' => 'cw','CXR' => 'cx','CYP' => 'cy','CZE' => 'cz','DEU' => 'de','DJI' => 'dj','DNK' => 'dk','DMA' => 'dm','DOM' => 'do','DZA' => 'dz','ECU' => 'ec','EST' => 'ee','EGY' => 'eg','ESH' => 'eh','ERI' => 'er','ESP' => 'es','ETH' => 'et','FIN' => 'fi','FJI' => 'fj','FLK' => 'fk','FSM' => 'fm','FRO' => 'fo','FRA' => 'fr','GAB' => 'ga','GBR' => 'gb','GRD' => 'gd','GEO' => 'ge','GUF' => 'gf','GGY' => 'gg','GHA' => 'gh','GIB' => 'gi','GRL' => 'gl','GMB' => 'gm','GIN' => 'gn','GLP' => 'gp','GNQ' => 'gq','GRC' => 'gr','SGS' => 'gs','GTM' => 'gt','GUM' => 'gu','GNB' => 'gw','GUY' => 'gy','HKG' => 'hk','HMD' => 'hm','HND' => 'hn','HRV' => 'hr','HTI' => 'ht','HUN' => 'hu','IDN' => 'id','IRL' => 'ie','ISR' => 'il','IMN' => 'im','IND' => 'in','IOT' => 'io','IRQ' => 'iq','IRN' => 'ir','ISL' => 'is','ITA' => 'it','JEY' => 'je','JAM' => 'jm','JOR' => 'jo','JPN' => 'jp','KEN' => 'ke','KGZ' => 'kg','KHM' => 'kh','KIR' => 'ki','COM' => 'km','KNA' => 'kn','PRK' => 'kp','KOR' => 'kr','KWT' => 'kw','CYM' => 'ky','KAZ' => 'kz','LAO' => 'la','LBN' => 'lb','LCA' => 'lc','LIE' => 'li','LKA' => 'lk','LBR' => 'lr','LSO' => 'ls','LTU' => 'lt','LUX' => 'lu','LVA' => 'lv','LBY' => 'ly','MAR' => 'ma','MCO' => 'mc','MDA' => 'md','MNE' => 'me','MAF' => 'mf','MDG' => 'mg','MHL' => 'mh','MKD' => 'mk','MLI' => 'ml','MMR' => 'mm','MNG' => 'mn','MAC' => 'mo','MNP' => 'mp','MTQ' => 'mq','MRT' => 'mr','MSR' => 'ms','MLT' => 'mt','MUS' => 'mu','MDV' => 'mv','MWI' => 'mw','MEX' => 'mx','MYS' => 'my','MOZ' => 'mz','NAM' => 'na','NCL' => 'nc','NER' => 'ne','NFK' => 'nf','NGA' => 'ng','NIC' => 'ni','NLD' => 'nl','NOR' => 'no','NPL' => 'np','NRU' => 'nr','NIU' => 'nu','NZL' => 'nz','OMN' => 'om','PAN' => 'pa','PER' => 'pe','PYF' => 'pf','PNG' => 'pg','PHL' => 'ph','PAK' => 'pk','POL' => 'pl','SPM' => 'pm','PCN' => 'pn','PRI' => 'pr','PSE' => 'ps','PRT' => 'pt','PLW' => 'pw','PRY' => 'py','QAT' => 'qa','REU' => 're','ROU' => 'ro','SRB' => 'rs','RUS' => 'ru','RWA' => 'rw','SAU' => 'sa','SLB' => 'sb','SYC' => 'sc','SDN' => 'sd','SWE' => 'se','SGP' => 'sg','SHN' => 'sh','SVN' => 'si','SJM' => 'sj','SVK' => 'sk','SLE' => 'sl','SMR' => 'sm','SEN' => 'sn','SOM' => 'so','SUR' => 'sr','SSD' => 'ss','STP' => 'st','SLV' => 'sv','SXM' => 'sx','SYR' => 'sy','SWZ' => 'sz','TCA' => 'tc','TCD' => 'td','ATF' => 'tf','TGO' => 'tg','THA' => 'th','TJK' => 'tj','TKL' => 'tk','TLS' => 'tl','TKM' => 'tm','TUN' => 'tn','TON' => 'to','TUR' => 'tr','TTO' => 'tt','TUV' => 'tv','TWN' => 'tw','TZA' => 'tz','UKR' => 'ua','UGA' => 'ug','UMI' => 'um','USA' => 'us','URY' => 'uy','UZB' => 'uz','VAT' => 'va','VCT' => 'vc','VEN' => 've','VGB' => 'vg','VIR' => 'vi','VNM' => 'vn','VUT' => 'vu','WLF' => 'wf','WSM' => 'ws','YEM' => 'ye','MYT' => 'yt','ZAF' => 'za','ZMB' => 'zm','ZWE' => 'zw'];
@endphp

@section('content')

@include('flash-message')

<!-- Modal -->
<div class="modal animated fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Löschen bestätigen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Soll die GGN: <span id="modal-ggn"></span> wirklich gelöscht werden?
            </div>
            <form action="/ggn/del" method="post">
                @csrf
                <input id="id" type="hidden" name="id" value="">
                <input id="ggn" type="hidden" name="ggn" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">abbrechen</button>
                    <button type="submit" class="btn btn-danger">löschen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-bottom:20px">
            
                    <div class="card-body">
                        <form method="POST" action="/ggn">
                            @csrf

                            <div class="form-group">
                                <input id="focus" min="1000000000000" max="9999999999999" type="number" class="form-control form-control-sm" name="ggn" placeholder="GGN" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">speichern</button>
                        </form>
                    </div>
                    
                </div>


                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">GGN</th>
                                    <th scope="col">Gruppen GGN</th>
                                    <th scope="col">Erzeuger</th>
                                    <th scope="col">Artikel</th>
                                    <th scope="col">Land</th>
                                    <th scope="col" style="text-align:right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($var['ggns'] as $ggn)
                                <tr>
                                    <td>{{$ggn->ggn}}</td>
                                    <td>{{$ggn->groupggn}}</td>
                                    <td>{{$ggn->erzeuger}}</td>
                                    <td>
                                        <a 
                                            style="padding-top:0;padding-bottom:0"
                                            tabindex="0"
                                            data-placement="left" 
                                            class="btn btn-lg btn-light btn-sm" 
                                            role="button" 
                                            data-toggle="popover" 
                                            data-trigger="focus"
                                            data-html="true"
                                            title="{{$ggn->erzeuger}}" 
                                            data-content="  @foreach($ggn->artikel as $artikel) 
                                                                @if($artikel->valid_to_current) {{strftime("%d.%m.%Y", strtotime($artikel->valid_to_current))}} 
                                                                @else &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                @endif 
                                                                {{$artikel->product_name}} <br> 
                                                            @endforeach"
                                        >{{$ggn->artikel_count}}</a>
                                    </td>
                                    <td>@if (strlen ($ggn->country) == 3) <span style="font-size:20px" class="flag-icon flag-icon-{{$land[$ggn->country]}}"></span> @endif {{$ggn->country}}</td>
                                    <td style="text-align:right">
                                        <a href="#Modal" data-toggle="modal" onclick="del({{$ggn->ggn}},{{$ggn->id}})" data-target="#Modal"><i class="material-icons" style="font-size:16px">delete_outline</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>

<script>
    function del(ggn,id) {
        $("#id").attr('value', id);
        $("#ggn").attr('value', ggn);
        $("#modal-ggn").text(ggn);
    };

    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>

@endsection