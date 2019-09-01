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
                Soll der Artikel: <span id="modal-artikel"></span> wirklich gelöscht werden?
            </div>
            <form action="/artikel" method="post">
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

                    @if (isset($var['artikel_edit']))
                        <form method="POST" action="/artikel/{{$var['artikel_edit']->id}}" > @method('put')
                    @else
                        <form method="POST" action="/artikel">
                    @endif

                        @csrf
                        <div class="form-row">
                            <div class="col-md-10">
                                <input id="focus" list="gesperrte" @if (isset($var['artikel_edit'])) value="{{$var['artikel_edit']->bezeichnung}}" @endif type="text" class="form-control form-control-sm" name="bezeichnung" placeholder="Artikelbezeichnung" required>
                                <datalist id="gesperrte">
                                    @foreach ($var['artikel_gesperrt'] as $artikel)
                                        <option value="{{$artikel->bezeichnung}}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-md-2" style="text-align:right">
                                <button type="submit" class="btn btn-primary btn-sm"> @if (isset($var['artikel_edit'])) aktualisieren @else hinzufügen @endif </button>
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
                                <th scope="col">Artikel</th>
                                <th scope="col" style="text-align:right">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($var['artikel'] as $artikel)
                            <tr>
                                <td>
                                    <a href="/artikel/{{$artikel->id}}/ggn/">{{$artikel->bezeichnung}}</a>
                                </td>
                                <td style="text-align:right">
                                    <a href="/artikel/{{$artikel->id}}/edit"><i class="material-icons" style="font-size:16px">create</i></a>
                                    <a href="#Modal" data-toggle="modal" onclick="del('{{$artikel->bezeichnung}}',{{$artikel->id}})" data-target="#Modal"><i class="material-icons" style="font-size:16px">check_circle_outline</i></a>
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
        $("#modal-artikel").text(bezeichnung);
    };
</script>
@endsection
