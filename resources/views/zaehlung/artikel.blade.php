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
    <p><a href="/zaehlung/{{$var['zaehlung_id']}}"></a> / <a href="#">?</a></p>
    <div class="list-group">
        @foreach ($var['artikel'] as $item)
            <a href="/zaehlung/{{$var['zaehlung_id']}}/kunde/{{$var['kunde_id']}}" class="list-group-item list-group-item-action">
                {{$item->bezeichnung}}
            </a>
        @endforeach
    </div>
</div>
@endsection