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
            <div class="list-group-item list-group-item-action">
                <a href="zaehlung/{{$item->id}}">Zählung vom {{$wochentag[strftime("%u", strtotime($item->created_at))]}} den {{strftime("%d.%m.%Y", strtotime($item->created_at))}} </a>
                    @if (Auth::user()->role > 1)
                        <div class="float-right" style="padding-top: 3px">
                            <a class="btn btn-primary btn-sm" href="export/{{$item->id}}" role="button" style="padding-bottom:0px"><i class="material-icons">description</i></a>
                            <a class="btn btn-success btn-sm" href="#" role="button" style="padding-bottom:0px"><i class="material-icons">info</i></a>
                        </div>
                    @endif
                <p style="margin-bottom:0;font-style:italic"><small>{{$item->name}}</small></p>
            </div>
        @endforeach

        @if (Auth::user()->role > 1)
            @foreach ($var['alle_zaehlungen'] as $item)
                <div class="list-group-item list-group-item-action">
                    <a href="zaehlung/{{$item->id}}">Zählung vom {{$wochentag[strftime("%u", strtotime($item->created_at))]}} den {{strftime("%d.%m.%Y", strtotime($item->created_at))}} </a>
                        <div class="float-right" style="padding-top: 3px">
                            <a class="btn btn-primary btn-sm" href="export/{{$item->id}}" role="button" style="padding-bottom:0px"><i class="material-icons">description</i></a>
                            <a class="btn btn-success btn-sm" href="#" role="button" style="padding-bottom:0px"><i class="material-icons">info</i></a>
                        </div>
                    <p style="margin-bottom:0;font-style:italic"><small>{{$item->name}}</small></p>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection