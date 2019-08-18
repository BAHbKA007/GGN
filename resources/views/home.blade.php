@php
    $wochentag = ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag']
@endphp

@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hallo {{$var['user']}}</div>

                <div class="card-body">
                    Am {{$wochentag[getdate(time())['wday']]}} den {{date("d.m.Y", time())}} um {{date("H:i", time())}} Uhr, KW: {{date('W')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection