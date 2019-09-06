@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card" style="margin-bottom:20px">
                <div class="card-header bg-primary text-white">neues Programm erstellen</div>
                <div class="card-body">
                    @if (isset($var['programm_edit']))
                        <form method="POST" action="/programm/{{$var['programm_edit']->id}}" > @method('put')
                    @else
                        <form method="POST" action="/programm">
                    @endif
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="von">von:</label>
                                <input type="date" class="form-control form-control-sm" name="von" placeholder="von z.B. '2019-12-31'" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bis">bis:</label>
                                <input type="date" class="form-control form-control-sm" name="bis" placeholder="bis z.B. '2019-12-31'" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="bis">Bezeichnung:</label>
                                <input type="text" class="form-control form-control-sm" name="pro_name" placeholder="...">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">erstellen</button>
                    </form>
                </div>
            </div>

            @include('flash-message')

            <div class="list-group">
                <div class="list-group-item list-group-item-action active">
                    Programmübersicht
                </div>

                @foreach ($var['programm'] as $item)
                    <li class="list-group-item list-group-item-action"> 
                        <strong>{{$item->pro_name}}:</strong> {{date('d.m.Y', strtotime($item->von))}} - {{date('d.m.Y', strtotime($item->bis))}} 
                        <small>( {{$item->name}} )</small>
                        <span class="float-right">
                            <a class="btn btn-primary btn-sm" href="programm/{{$item->id}}" role="button">Kunde</a>
                            <a class="btn btn-primary btn-sm" href="programm_artikel/{{$item->id}}" role="button">Artikel</a>
                        </span>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection