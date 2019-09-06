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
    <div class="list-group">
        @foreach ($var['artikel'] as $artikel)
            <a href="/artikel/{{$artikel->id}}/ggn/" class="list-group-item list-group-item-action">{{$artikel->bezeichnung}}</a>
        <tr>
            <td>
                <a href="/artikel/{{$artikel->id}}/ggn/">{{$artikel->bezeichnung}}</a>
            </td>
        </tr>
        @endforeach
        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
        <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col">Artikel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($var['artikel'] as $artikel)
                    <tr>
                        <td>
                            <a href="/artikel/{{$artikel->id}}/ggn/">{{$artikel->bezeichnung}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection