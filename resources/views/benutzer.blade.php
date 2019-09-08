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
                Soll der Benutzer: <span id="modal-benutzer" style="font-weight: bold;"></span> wirklich gesperrt werden?
            </div>
            <form action="/benutzer" method="post">
                @method('delete')
                @csrf
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
                        @if (isset($var['edit_benutzer']))
                            <form method="POST" action="/benutzer/{{$var['edit_benutzer']->id}}" > @method('put')
                        @else
                            <form method="POST" action="/benutzer">
                        @endif
                            @csrf
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <input type="text" class="form-control form-control-sm" @if (isset($var['edit_benutzer'])) value="{{$var['edit_benutzer']->name}}" @endif id="validationCustom03" name="name" placeholder="Name" required autocomplete="off">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="email" class="form-control form-control-sm" @if (isset($var['edit_benutzer'])) value="{{$var['edit_benutzer']->email}}" @endif id="validationCustom04" name="email" placeholder="E-Mail" required autocomplete="off">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input class="form-control form-control-sm" id="validationCustom05" name="password" placeholder="Passwort" type="password" @if (!isset($var['edit_benutzer'])) required @endif autocomplete="off">
                                </div>
                                <div class="col-md-1 mb-3">
                                    <select class="form-control form-control-sm" name="role" >
                                        @if (isset($var['edit_benutzer'])) <option hidden selected value="{{$var['edit_benutzer']->rolesid}}">{{$var['edit_benutzer']->rolesname}}</option> @endif
                                        @foreach ($var['roles'] as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-sm" type="submit"> @if (!isset($var['edit_benutzer'])) Benutzer hinzufügen @else Benutzer aktualisieren @endif </button>
                        </form>
                    </div>
                    
                </div>

                @include('flash-message')

                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Rolle</th>
                                    <th scope="col" style="text-align:right">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($var['benutzer'] as $benutzer)
                                <tr>
                                    <td>{{$benutzer->id}}</td>
                                    <td>{{$benutzer->name}}</td>
                                    <td>{{$benutzer->email}}</td>
                                    <td>{{$benutzer->rolesname}}</td>
                                    <td style="text-align:right"> 
                                        <a href="/benutzer/{{$benutzer->id}}/edit"><i class="material-icons" style="font-size:16px">create</i></a> 
                                        <a href="#Modal" data-toggle="modal" data-target="#Modal" onclick="del('{{$benutzer->name}}',{{$benutzer->id}})"><i class="material-icons" style="font-size:16px">highlight_off</i></a>
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
        $("#modal-benutzer").text(bezeichnung);
    };

</script>
@endsection

