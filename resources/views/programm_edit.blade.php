@extends('layouts.app')

@section('content')

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
                Soll der Kunde: <span id="modal-artikel"></span> wirklich aus dem Programm entfernt werden?
            </div>
            <form action="/programmkunde" method="post">
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

            <div class="list-group">
                <div class="list-group-item list-group-item-action active">
                    @if (sizeof($var['kunden']) == 0)
                        Kunden:
                    @else
                        Durch ziehen oder mit gedrückter STRG-Taste Kunden zum Programm <strong>"{{$var['programm_edit']->pro_name}}"</strong> hinzufügen:
                        <div>
                        <form method="POST" action="/programmkunde">
                            <input type="number" name="pro_id" value="{{$var['programm_edit']->id}}" hidden>
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
                    @endif
                </div>

                @foreach ($var['programmkunden'] as $item)
                <div href="{{$item->id}}" class="list-group-item list-group-item-action">
                    <div class="custom-control custom-checkbox">
                        <a href="/programm/{{$var['programm_edit']->id}}/{{$item->id}}">{{$item->name}}</a>@if ($item->art_count > 0) <span class="badge badge-primary" style="margin-left:10px">{{$item->art_count}} Artikel</span>@endif
                        <div class="float-right">
                            <a href="" onclick="delet('{{$item->name}}',{{$item->id}})" href="#Modal" data-toggle="modal" data-target="#Modal">
                                <i class="material-icons" style="font-size:16px">delete_outline</i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @include('flash-message')

            <div class="card" style="margin-top:20px">
                    <div class="card-header bg-primary text-white">@if (isset($var['programm_edit'])) Programm bearbeiten @else neues Programm erstellen @endif</div>
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
                                    <input type="date" class="form-control form-control-sm" name="von" placeholder="von z.B. '2019-12-31'" required  @if (isset($var['programm_edit'])) value="{{$var['programm_edit']->von}}" @endif>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bis">bis:</label>
                                    <input type="date" class="form-control form-control-sm" name="bis" placeholder="bis z.B. '2019-12-31'" required @if (isset($var['programm_edit'])) value="{{$var['programm_edit']->bis}}" @endif>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="bis">Bezeichnung:</label>
                                    <input type="text" class="form-control form-control-sm" name="pro_name" placeholder="..." @if (isset($var['programm_edit'])) value="{{$var['programm_edit']->pro_name}}" @endif autocomplete="off">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">@if (isset($var['programm_edit'])) aktualisieren @else erstellen @endif</button>
                        </form>
                    </div>
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