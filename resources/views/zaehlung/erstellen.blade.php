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
            <button id="lodingButton" class="btn btn-primary" type="button" data-form="neue_zaehlung">
                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                <span id="btn-txt">Neue Zählung</span>
            </button>
        </form>
    </div>

    <div class="list-group" style="margin-top:24px">

        @include('zaehlung.include.qmlist')

        @if (Auth::user()->role > 1)
        {{ $var['alle_zaehlungen']->links() }}
        @endif
    </div>
</div>

@endsection