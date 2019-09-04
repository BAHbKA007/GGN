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
            <div class="card" style="margin-bottom:20px">
            
                    <div class="card-body">
                        <form method="POST" action="/ggn">
                            @csrf

                            <div class="form-group">
                                <input id="focus" min="1000000000000" max="9999999999999" type="number" class="form-control form-control-sm" name="ggn" placeholder="GGN" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">speichern</button>
                        </form>
                    </div>
                    
                </div>

            @include('flash-message')

                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">GGN</th>
                                    <th scope="col">Gruppen GGN</th>
                                    <th scope="col">Erzeuger</th>
                                    <th scope="col">Artikel</th>
                                    <th scope="col">Land</th>
                                    <th scope="col" style="text-align:right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($var['ggns'] as $ggn)
                                <tr>
                                    <td>{{$ggn->ggn}}</td>
                                    <td>{{$ggn->groupggn}}</td>
                                    <td>{{$ggn->erzeuger}}</td>
                                    <td>{{$ggn->artikel_count}}</td>
                                    <td>{{$ggn->country}}</td>
                                    <td style="text-align:right">
                                        <a href="#Modal" data-toggle="modal" onclick="del({{$ggn->ggn}},{{$ggn->id}})" data-target="#Modal"><i class="material-icons" style="font-size:16px">delete_outline</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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