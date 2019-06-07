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
    {{-- <p><a href="/zaehlung/{{$var['id']}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a> / <a href="#">?</a></p> --}}
    <div class="list-group">
        @foreach ($var['kunden'] as $item)
            <a href="/zaehlung/{{$var['zaehlung']->id}}/kunde/{{$item->id}}" class="list-group-item list-group-item-action">
                {{$item->name}}
            </a>
        @endforeach
    </div>
</div>
@endsection