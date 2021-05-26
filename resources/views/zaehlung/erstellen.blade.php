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

@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="col-md-12 text-center"> 
        <form action="/zaehlung/neu" method="post" id="neue_zaehlung">
            @csrf
            <button id="lodingButton" class="btn btn-primary lodingButton" type="button" data-form="neue_zaehlung" onclick='this.disabled = true;'>
                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                <span id="btn-txt">Neue leere Zählung</span>
            </button>
        </form>
        <br>
        <form action="/zaehlung/neu_vorbelegt" method="post" id="neue_zaehlung">
            @csrf
            <button id="lodingButton" class="btn btn-success lodingButton" type="button" data-form="neue_zaehlung" onclick='this.disabled = true;'>
                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                <span id="btn-txt">Neue Zählung mit vorbelegten Artikeln</span>
            </button>
        </form>
    </div>

    <div class="list-group" style="margin-top:24px">

        @include('zaehlung.include.qmlist')

        @if (Auth::user()->role > 1)
        {{ $var['alle_zaehlungen']->links() }}
        @endif
    </div>
    @if (Auth::user()->role == 1 )
    <div class="card">
        <div class="card-header" style="font-weight:bold">
            Update 14.02.2021
        </div>
        <div class="card-body">
            <p class="card-text">Hallo {{Auth::user()->name}},</p>
            <p class="card-text">ab sofort können neben GGNs auch die Verschiedenen Leergutarten eingetragen werden</p>
        </div>
    </div>
    @endif
</div>

@endsection