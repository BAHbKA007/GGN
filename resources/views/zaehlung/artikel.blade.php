@php
$wochentag = [
    1 => 'Montag',
    2 => 'Dienstag',
    3 => 'Mittwoch',
    4 => 'Donnerstag',
    5 => 'Freitag',
    6 => 'Samstag',
    7 => 'Sonntag'
]
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
                    <form method="POST" action="/zaehlung/artikel" autocomplete="off">
                        @csrf
                        <input name="artikel_id" value="{{$var['artikel_id']}}" hidden>
                        <input name="kunde_id" value="{{$var['kunde_id']}}" hidden>
                        <input name="zaehlung_id" value="{{$var['zaehlung_id']}}" hidden>
                        <div class="form-row">
                            <div class="col-6">
                                <input id="focus" class="form-control" type="number" min="1000000000000" max="9999999999999" name="ggn" placeholder="GGN" required>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="menge" placeholder="Menge" required>
                            </div>
                            <div class="col" style="text-align:right">
                                <button type="submit" class="btn btn-primary mb-2">Bestätigen</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="list-group">
                @foreach ($var['gezaehlte'] as $item)
                    <li class="list-group-item"><span style="width: 60px;float: left;"><strong>{{$item->menge}}x</strong></span> {{$item->ggn}}<span style="float: right;">
                        <a href="#Modal" data-toggle="modal" onclick="del('{{$item->zaehlpos_id}}')" data-target="#Modal">
                            <i class="material-icons" style="font-size:16px">delete_outline</i>
                        </a></span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@include('layouts.kommentare_modal')

<script>
    
    // Modal einblenden
    function del(id) {
        $("#id").attr('value', id);
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