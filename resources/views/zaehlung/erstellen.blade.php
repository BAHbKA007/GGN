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
        <form action="/zaehlung/neu" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Neue Zählung</button>
        </form>
    </div>

    <div class="list-group" style="margin-top:24px">

        @include('zaehlung.include.qmlist')

    </div>
</div>
@endsection