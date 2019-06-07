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
        @foreach ($var['zaehlungen'] as $item)
            <a href="zaehlung/{{$item->id}}" class="list-group-item list-group-item-action">
                Zählung vom {{$wochentag[strftime("%u", strtotime($item->created_at))]}} den {{strftime("%d.%m.%Y", strtotime($item->created_at))}} 
                <p style="margin-bottom:0"><small>{{$item->name}}</small></p>
            </a>
        @endforeach
    </div>
</div>
@endsection