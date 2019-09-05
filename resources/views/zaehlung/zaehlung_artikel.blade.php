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
    <p><a href="/zaehlung/{{$var['zaehlung']->id}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a> / <a href=""><b>{{$var['kunde']->name}}</b></a></p>
    <div class="list-group">
        @foreach ($var['artikel'] as $item)
            <a href="/zaehlung/{{$var['zaehlung']->id}}/kunde/{{$var['kunde']->id}}/artikel/{{$item->id}}" class="list-group-item list-group-item-action" style="padding-top: 12px;padding-bottom: 12px">
                {{$item->bezeichnung}} @if ($item->summe > 0) <span class="badge badge-primary" style="margin-left:10px;">{{$item->summe}} Kolli</span> @endif
            </a>
        @endforeach
    </div>
</div>

@include('layouts.kommentare_modal')

@endsection