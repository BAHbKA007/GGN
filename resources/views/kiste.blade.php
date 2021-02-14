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
                Soll die Leergutart: <span id="modal-kiste" style="font-weight: bold;"></span> wirklich gelöscht werden?
            </div>
            <form action="/kiste" method="post">
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
            
            <div class="card" style="margin-bottom:20px">
                
                <div class="card-body">

                    @if (isset($var['kiste_edit']))
                        <form method="POST" action="/kiste/{{$var['kiste_edit']->id}}" > @method('put')
                    @else
                        <form method="POST" action="/kiste">
                    @endif

                        @csrf
                        <div class="form-row">
                            <div class="col-md-3">
                                <input id="focus" @if (isset($var['kiste_edit'])) value="{{$var['kiste_edit']->ArtikelNummer}}" @endif type="text" class="form-control form-control-sm" name="ArtikelNummer" placeholder="Artikelnummer" required>
                            </div>
                            <div class="col-md-8">
                                <input id="focus" @if (isset($var['kiste_edit'])) value="{{$var['kiste_edit']->bezeichnung}}" @endif type="text" class="form-control form-control-sm" name="bezeichnung" placeholder="Bezeichnung" required>
                            </div>
                            <div class="col-md-1" style="text-align:right">
                                <button type="submit" class="btn btn-primary btn-sm"> @if (isset($var['kiste_edit'])) aktualisieren @else hinzufügen @endif </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>

            @include('flash-message')

            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Artikelnummer</th>
                                <th scope="col">Bezeichnung</th>
                                <th scope="col" style="text-align:right">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($var['kiste'] as $kiste)
                            <tr>
                                <td>
                                    {{$kiste->ArtikelNummer}}
                                </td>
                                
                                <td>
                                    {{$kiste->bezeichnung}}
                                </td>
                                <td style="text-align:right">
                                    <a href="/kiste/{{$kiste->id}}/edit"><i class="material-icons" style="font-size:16px">create</i></a>
                                    <a href="#Modal" data-toggle="modal" data-target="#Modal" onclick="del('{{$kiste->bezeichnung}}',{{$kiste->id}})"><i class="material-icons" style="font-size:16px">highlight_off</i></a>
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
   
    function del(bezeichnung,id) {
        $("#id").attr('value', id);
        $("#modal-kiste").text(bezeichnung);
    };
</script>

@endsection
