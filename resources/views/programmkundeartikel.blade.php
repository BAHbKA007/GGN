@extends('layouts.app')

@section('content')
@include('flash-message')

<!-- Modal -->
<div class="modal animated fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Löschen bestätigen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Soll der Artikel: <span id="modal-artikel"></span> wirklich aus dem Programm entfernt werden?
            </div>
            <form action="/programmkundeartikel" method="post">
                @method('delete')
                @csrf
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">abbrechen</button>
                    <button type="submit" class="btn btn-danger">löschen</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                        <div class="float-right">
                            <a href="" onclick="delet('{{$item->bezeichnung}}',{{$item->id}})" href="#Modal" data-toggle="modal" data-target="#Modal">
                                <i class="material-icons" style="font-size:16px">delete_outline</i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
   
    function delet(bezeichnung,id) {
        $("#id").attr('value', id);
        $("#modal-artikel").text(bezeichnung);
    };

</script>
@endsection