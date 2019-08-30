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

    <div class="list-group">

        @include('zaehlung.include.lagerlist')

        @include('zaehlung.include.qmlist')

    </div>
</div>
@endsection