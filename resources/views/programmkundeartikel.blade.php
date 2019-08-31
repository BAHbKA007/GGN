@extends('layouts.app')

@section('content')
@include('flash-message')
//TODO Modal
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <p><a href="/programm/{{$var['programm']->id}}">{{$var['programm']->pro_name}}</a> / <a href="#">{{$var['kunde']->name}}</a></p>
            <div class="list-group">
                {{-- <div class="list-group-item list-group-item-action active">
                    Artikel hinzufügen:
                    <div>

                    <select class="custom-select custom-select-sm" id="artikel_add" onchange="artikel_add('{{$var['id']}}');">
                            <option selected hidden>...</option>
                            @foreach ($var['artikel'] as $item)
                                <option value="{{$item->id}}">{{$item->bezeichnung}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="list-group-item list-group-item-action active">
                        @if (sizeof($var['artikel']) == 0)
                            Artikel:
                        @else
                            Durch ziehen oder mit gedrückter STRG-Taste Artikel zum Kunden <strong>"{{$var['kunde']->name}}"</strong> hinzufügen:
                            <div>
                            <form method="POST" action="/programmkundeartikel">
                                <input type="number" name="prokun_id" value="{{$var['id']}}" hidden>
                                @csrf
                                <div class="form-group">
                                    <select multiple class="form-control" name="artikel[]" size="{{sizeof($var['artikel'])}}">
                                        @foreach ($var['artikel'] as $item)
                                            <option value="{{$item->id}}">{{$item->bezeichnung}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-light btn-sm">hinzufügen</button>
                            </form>
    
                            </div>
                        @endif
                    </div>

                @foreach ($var['programmkundeartikel'] as $item)
                <div href="{{$item->id}}" class="list-group-item list-group-item-action">
                    <div class="custom-control custom-checkbox">
                        {{$item->bezeichnung}}
                    <div class="float-right"><a href="" onclick="del_artikel('{{$item->id}}','{{$item->bezeichnung}}','{{$var['id']}}')"><i class="material-icons" style="font-size:16px">delete_outline</i></a></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection