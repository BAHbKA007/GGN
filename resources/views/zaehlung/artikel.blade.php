@php
$wochentag = [
    1 => 'Montag',
    2 => 'Dienstag',
    3 => 'Mittwoch',
    4 => 'Donnerstag',
    5 => 'Freitag',
    6 => 'Samstag',
    7 => 'Sonntag'
];

$land = ['AND' => 'ad','ARE' => 'ae','AFG' => 'af','ATG' => 'ag','AIA' => 'ai','ALB' => 'al','ARM' => 'am','AGO' => 'ao','ATA' => 'aq','ARG' => 'ar','ASM' => 'as','AUT' => 'at','AUS' => 'au','ABW' => 'aw','ALA' => 'ax','AZE' => 'az','BIH' => 'ba','BRB' => 'bb','BGD' => 'bd','BEL' => 'be','BFA' => 'bf','BGR' => 'bg','BHR' => 'bh','BDI' => 'bi','BEN' => 'bj','BLM' => 'bl','BMU' => 'bm','BRN' => 'bn','BOL' => 'bo','BES' => 'bq','BRA' => 'br','BHS' => 'bs','BTN' => 'bt','BVT' => 'bv','BWA' => 'bw','BLR' => 'by','BLZ' => 'bz','CAN' => 'ca','CCK' => 'cc','COD' => 'cd','CAF' => 'cf','COG' => 'cg','CHE' => 'ch','CIV' => 'ci','COK' => 'ck','CHL' => 'cl','CMR' => 'cm','CHN' => 'cn','COL' => 'co','CRI' => 'cr','CUB' => 'cu','CPV' => 'cv','CUW' => 'cw','CXR' => 'cx','CYP' => 'cy','CZE' => 'cz','DEU' => 'de','DJI' => 'dj','DNK' => 'dk','DMA' => 'dm','DOM' => 'do','DZA' => 'dz','ECU' => 'ec','EST' => 'ee','EGY' => 'eg','ESH' => 'eh','ERI' => 'er','ESP' => 'es','ETH' => 'et','FIN' => 'fi','FJI' => 'fj','FLK' => 'fk','FSM' => 'fm','FRO' => 'fo','FRA' => 'fr','GAB' => 'ga','GBR' => 'gb','GRD' => 'gd','GEO' => 'ge','GUF' => 'gf','GGY' => 'gg','GHA' => 'gh','GIB' => 'gi','GRL' => 'gl','GMB' => 'gm','GIN' => 'gn','GLP' => 'gp','GNQ' => 'gq','GRC' => 'gr','SGS' => 'gs','GTM' => 'gt','GUM' => 'gu','GNB' => 'gw','GUY' => 'gy','HKG' => 'hk','HMD' => 'hm','HND' => 'hn','HRV' => 'hr','HTI' => 'ht','HUN' => 'hu','IDN' => 'id','IRL' => 'ie','ISR' => 'il','IMN' => 'im','IND' => 'in','IOT' => 'io','IRQ' => 'iq','IRN' => 'ir','ISL' => 'is','ITA' => 'it','JEY' => 'je','JAM' => 'jm','JOR' => 'jo','JPN' => 'jp','KEN' => 'ke','KGZ' => 'kg','KHM' => 'kh','KIR' => 'ki','COM' => 'km','KNA' => 'kn','PRK' => 'kp','KOR' => 'kr','KWT' => 'kw','CYM' => 'ky','KAZ' => 'kz','LAO' => 'la','LBN' => 'lb','LCA' => 'lc','LIE' => 'li','LKA' => 'lk','LBR' => 'lr','LSO' => 'ls','LTU' => 'lt','LUX' => 'lu','LVA' => 'lv','LBY' => 'ly','MAR' => 'ma','MCO' => 'mc','MDA' => 'md','MNE' => 'me','MAF' => 'mf','MDG' => 'mg','MHL' => 'mh','MKD' => 'mk','MLI' => 'ml','MMR' => 'mm','MNG' => 'mn','MAC' => 'mo','MNP' => 'mp','MTQ' => 'mq','MRT' => 'mr','MSR' => 'ms','MLT' => 'mt','MUS' => 'mu','MDV' => 'mv','MWI' => 'mw','MEX' => 'mx','MYS' => 'my','MOZ' => 'mz','NAM' => 'na','NCL' => 'nc','NER' => 'ne','NFK' => 'nf','NGA' => 'ng','NIC' => 'ni','NLD' => 'nl','NOR' => 'no','NPL' => 'np','NRU' => 'nr','NIU' => 'nu','NZL' => 'nz','OMN' => 'om','PAN' => 'pa','PER' => 'pe','PYF' => 'pf','PNG' => 'pg','PHL' => 'ph','PAK' => 'pk','POL' => 'pl','SPM' => 'pm','PCN' => 'pn','PRI' => 'pr','PSE' => 'ps','PRT' => 'pt','PLW' => 'pw','PRY' => 'py','QAT' => 'qa','REU' => 're','ROU' => 'ro','SRB' => 'rs','RUS' => 'ru','RWA' => 'rw','SAU' => 'sa','SLB' => 'sb','SYC' => 'sc','SDN' => 'sd','SWE' => 'se','SGP' => 'sg','SHN' => 'sh','SVN' => 'si','SJM' => 'sj','SVK' => 'sk','SLE' => 'sl','SMR' => 'sm','SEN' => 'sn','SOM' => 'so','SUR' => 'sr','SSD' => 'ss','STP' => 'st','SLV' => 'sv','SXM' => 'sx','SYR' => 'sy','SWZ' => 'sz','TCA' => 'tc','TCD' => 'td','ATF' => 'tf','TGO' => 'tg','THA' => 'th','TJK' => 'tj','TKL' => 'tk','TLS' => 'tl','TKM' => 'tm','TUN' => 'tn','TON' => 'to','TUR' => 'tr','TTO' => 'tt','TUV' => 'tv','TWN' => 'tw','TZA' => 'tz','UKR' => 'ua','UGA' => 'ug','UMI' => 'um','USA' => 'us','URY' => 'uy','UZB' => 'uz','VAT' => 'va','VCT' => 'vc','VEN' => 've','VGB' => 'vg','VIR' => 'vi','VNM' => 'vn','VUT' => 'vu','WLF' => 'wf','WSM' => 'ws','YEM' => 'ye','MYT' => 'yt','ZAF' => 'za','ZMB' => 'zm','ZWE' => 'zw'];

@endphp

<style>
    
    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    
    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }
    
    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff; 
        border-bottom: 1px solid #d4d4d4; 
    }
    
    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9; 
    }
    
    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important; 
        color: #ffffff; 
    }
</style>

@extends('layouts.app')

@section('content')
@include('flash-message')

<!-- Modal löschen -->
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
                Soll die Position wirklich gelöscht werden?
            </div>
            <form action="/zaehlposition" method="post">
                @method('delete')
                @csrf
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">abbrechen</button>
                    <button type="submit" class="btn btn-danger">löschen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal bearbeiten-->
<div class="modal animated fade" id="Modal_bearbeiten" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">GGN <span style="font-weight: bold;" id="ggn_bearbeiten"></span> Bearbeiten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/zaehlposition" method="post" id="form_bearbeiten">
                @csrf
                <input id="id_bearbeiten" type="hidden" name="id" value="">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Menge</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="menge_bearbeiten" name="menge" value="">
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">abbrechen</button>
                    <button id="lodingButton" class="btn btn-primary lodingButton" type="submit" data-form="form_bearbeiten">
                        <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                        <span id="btn-txt">speichern</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <p>
        <a href="/zaehlung/{{$var['zaehlung']->id}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a>
            / <a href="/zaehlung/{{$var['zaehlung']->id}}/kunde/{{$var['kunde_id']}}">{{$var['kunde']->name}}</a>
            / <a href=""><b>{{$var['artikel'][0]->bezeichnung}}</b></a>
    </p>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-bottom:20px">
                <div class="card-body">
                    <form method="POST" action="/zaehlung/artikel" autocomplete="off" id="ggn">
                        @csrf
                        <input name="artikel_id" value="{{$var['artikel_id']}}" hidden>
                        <input name="kunde_id" value="{{$var['kunde_id']}}" hidden>
                        <input name="zaehlung_id" value="{{$var['zaehlung_id']}}" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">GGN</label>
                                <input id="focus" type="number" class="form-control" value="{{ old('ggn') }}" min="1000000000000" max="9999999999999" name="ggn" placeholder="GGN" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Menge</label>
                                <input type="number" class="form-control" value="{{ old('menge') }}" name="menge" placeholder="Menge" required>
                            </div>
                        </div>
                        <button id="lodingButton" class="btn btn-primary lodingButton" type="button" data-form="ggn">
                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                            <span id="btn-txt">O.K.</span>
                        </button>
                    </form>
                </div>
            </div>

            <ul class="list-group">
                @foreach ($var['gezaehlte'] as $item)
                    <li class="list-group-item @if ($item->menge == 0) bg-warning @endif" >
                        <span style="width: 60px;float: left;">
                            <strong>{{$item->menge}}x</strong>
                        </span> {{$item->ggn}}
                        @if (strlen ($item->country) == 3) <small style="padding-left:25px"><span style="font-size:20px" class="flag-icon flag-icon-{{$land[$item->country]}}"></span> {{$item->country}}</small> @endif
                        <span style="float: right;">
                            <a id="modal_button" href="#Modal_bearbeiten" data-toggle="modal" data-id="{{$item->id}}" data-target="#Modal_bearbeiten" style="margin-right:5px">
                                <i class="material-icons" onclick="edit({{$item->id}},{{$item->menge}},{{$item->ggn}})" style="font-size:16px">create</i>
                            </a>
                            <a id="modal_button" href="#Modal" data-toggle="modal" data-id="{{$item->id}}" data-target="#Modal">
                                <i class="material-icons" onclick="del({{$item->id}})" style="font-size:16px">delete_outline</i>
                            </a>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@include('layouts.kommentare_modal')

<script>

    function del(id) {
        $("#id").attr('value', id);
    };

    function edit(id,menge,ggn) {
        $("#id_bearbeiten").attr('value', id);
        $("#menge_bearbeiten").attr('value', menge);
        $("#ggn_bearbeiten").text(ggn);
    };

    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
            } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
            } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
            }
        });
        function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
        }
        function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
            }
        }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }
    
    /*An array containing all the country names in the world:*/

    var countries = [<?php foreach ($var['ggns'] as $item) { echo '"'.$item->ggn.'",'; };?>];
    
    /*initiate the autocomplete function on the "focus" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("focus"), countries);
</script>

@endsection