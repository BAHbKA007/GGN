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
                Soll die GGN: <span id="modal-ggn"></span> wirklich gelöscht werden?
            </div>
            <form action="/ggn/del" method="post">
                @csrf
                <input id="id" type="hidden" name="id" value="">
                <input id="ggn" type="hidden" name="ggn" value="">
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
            {{-- <p><a href="/programm/{{$var['programm']->id}}">{{$var['programm']->pro_name}}</a> / <a href="#">{{$var['kunde']->name}}</a></p> --}}
            <div class="list-group">

                <div class="list-group-item list-group-item-action active">
                GGNs zu "{{$var['artikel']->bezeichnung}}" hinzufügen
                    <div>
                        <form method="POST" action="/artikel/{{$var['art_id']}}/ggn" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <input id="focus" class="form-control" list="ggns" maxlength="13" name="ggn" required>
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
                            <div class="float-right">
                                <a href="#Modal" data-toggle="modal" onclick="del({{$item->ggn}},{{$item->id}})" data-target="#Modal"><i class="material-icons" style="font-size:16px">delete_outline</i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        document.getElementById("focus").focus();
    };

    function del(ggn,id) {
        $("#id").attr('value', id);
        $("#ggn").attr('value', ggn);
        $("#modal-ggn").text(ggn);
    };
</script>

@endsection