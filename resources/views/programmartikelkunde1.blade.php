@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="list-group-item list-group-item-action active">
        Durch ziehen oder mit gedrückter STRG-Taste Artikel <strong>"{{$var['artikel']->bezeichnung}}"</strong> zu Kunden hinzufügen:
        <div>
            <form method="POST" action="/programm_artikel/artikel/store">
                <input type="number" name="programm_id" value="{{$var['id']}}" hidden>
                <input type="number" name="artikel_id" value="{{$var['artikel']->id}}" hidden>
                @csrf
                <div class="form-group">
                    <select multiple class="form-control" name="kunden[]" size="{{sizeof($var['kunden'])}}">
                        @foreach ($var['kunden'] as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-light btn-sm">hinzufügen</button>
            </form>
        </div>
    </div>
</div>

@endsection