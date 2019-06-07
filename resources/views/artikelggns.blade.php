@extends('layouts.app')

@section('content')
@include('flash-message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <p><a href="/programm/{{$var['programm']->id}}">{{$var['programm']->pro_name}}</a> / <a href="#">{{$var['kunde']->name}}</a></p> --}}
            <div class="list-group">

                <div class="list-group-item list-group-item-action active">
                GGNs zu "{{$var['artikel']->bezeichnung}}" hinzufügen
                    <div>
                        <form method="POST" action="/artikel/{{$var['art_id']}}/ggn" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" list="ggns" maxlength="13" name="ggn" required>
                                <datalist id="ggns">
                                    @foreach ($var['ggns'] as $item)
                                        <option value="{{$item->ggn}}">{{$item->erzeuger}} <small>{{$item->ggn}}</small></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <button type="submit" class="btn btn-light btn-sm">hinzufügen</button>
                        </form>
                    </div>

                </div>
                @foreach ($var['ggnsartikel'] as $item)
                    <div href="#" class="list-group-item list-group-item-action">
                        <div class="custom-control custom-checkbox">
                            {{$item->ggn}} <small>{{$item->erzeuger}}</small>
                            <div class="float-right"><a href="" >L</a></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection