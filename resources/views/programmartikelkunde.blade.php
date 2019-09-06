@extends('layouts.app')

@section('content')

<div class="container">
    <div class="list-group">
        @foreach ($var['artikel'] as $artikel)
            <a href="/programm_artikel/{{$var['id']}}/artikel/{{$artikel->id}}" class="list-group-item list-group-item-action">{{$artikel->bezeichnung}}</a>
        @endforeach
    </div>
</div>

@endsection