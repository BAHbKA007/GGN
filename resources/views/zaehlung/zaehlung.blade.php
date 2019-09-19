@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    {{-- <p><a href="/zaehlung/{{$var['id']}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a> / <a href="#">?</a></p>  --}}
    <div class="list-group">
        @foreach ($var['kunden'] as $item)
            <a id="{{$item->id}}" class="list-group-item list-group-item-action my-list-spinner @if ($item->nullmenge != 0) bg-warning @endif"  style="padding-top: 12px;padding-bottom: 12px" href="/zaehlung/{{$var['zaehlung']->id}}/kunde/{{$item->id}}"> 
                {{$item->name}} 
                @if ($item->summe > 0)
                    <span class="badge badge-primary" style="margin-left:10px">{{$item->summe}} Kolli</span>
                @endif
                <div id="show{{$item->id}}" class='spinner-grow text-success float-right hide' style='width: 32px; height: 22px;' role='status'><span class='sr-only'>Loading...</span></div>
            </a>
        @endforeach
    </div>
</div>
@endsection