@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    {{-- <p><a href="/zaehlung/{{$var['id']}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a> / <a href="#">?</a></p> --}}
    <div class="list-group">
        @foreach ($var['kunden'] as $item)
            <a href="/zaehlung/{{$var['zaehlung']->id}}/kunde/{{$item->id}}" class="list-group-item list-group-item-action" style="padding-top: 12px;padding-bottom: 12px">
                {{$item->name}} @if ($item->summe > 0)
                    <span class="badge badge-primary" style="margin-left:10px">{{$item->summe}} Kolli</span>
                @endif 
            </a>
        @endforeach
    </div>
</div>
@endsection