@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal animated fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sperren bestätigen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Soll <span id="modal-kunde" style="font-weight: bold;"></span> wirklich gesperrt werden?
            </div>
            <form action="/kunden" method="post">
                @method('delete')
                @csrf
                <input id="name" type="hidden" name="name" value="">
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">abbrechen</button>
                    <button type="submit" class="btn btn-danger">sperren</button>
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

                        @if (isset($var['kunden_edit']))
                            <form method="POST" action="/kunden/{{$var['kunden_edit']->id}}" > @method('put')
                        @else
                            <form method="POST" action="/kunden">
                        @endif
                            @csrf
                            <div class="form-row">
                                <div class="col-md-10">
                                    <input id="focus" list="gesperrte" @if (isset($var['kunden_edit'])) value="{{$var['kunden_edit']->name}}" @endif type="text" class="form-control form-control-sm" name="name" placeholder="Kunde" required autocomplete="off">
                                    <datalist id="gesperrte">
                                        @foreach ($var['gesperrte'] as $kunde)
                                            <option value="{{$kunde->name}}">
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-md-2" style="text-align:right">
                                    <button type="submit" class="btn btn-primary btn-sm"> @if (isset($var['kunden_edit'])) aktualisieren @else hinzufügen @endif </button>
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
                                    <th scope="col">Name</th>
                                    <th scope="col" style="text-align:right">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($var['kunden'] as $kunde)
                                <tr>
                                    <td>{{$kunde->name}}</td>
                                    <td style="text-align:right">
                                        <a href="/kunden/{{$kunde->id}}/edit"><i class="material-icons" style="font-size:16px">create</i></a> 
                                        <a href="#Modal" data-toggle="modal" data-target="#Modal" onclick="del('{{$kunde->name}}',{{$kunde->id}})"><i class="material-icons" style="font-size:16px">highlight_off</i></a>
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
        $("#modal-kunde").text(bezeichnung);
        $("#name").attr('value', bezeichnung);
    };
    
</script>
@endsection
