@extends('layouts.app')

@section('content')
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
                                <input type="text" class="form-control form-control-sm" @if (isset($var['edit_benutzer'])) value="{{$var['edit_benutzer']->name}}" @endif id="validationCustom03" name="name" placeholder="Name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="email" class="form-control form-control-sm" @if (isset($var['edit_benutzer'])) value="{{$var['edit_benutzer']->email}}" @endif id="validationCustom04" name="email" placeholder="E-Mail" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input class="form-control form-control-sm" id="validationCustom05" name="password" placeholder="Passwort" type="text" @if (!isset($var['edit_benutzer'])) required @endif>
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
                                    <td style="text-align:right"> <a href="/benutzer/{{$benutzer->id}}/edit">B</a> <a href="#" onclick="del_data('benutzer', '{{$benutzer->id}}', '{{$benutzer->name}}')">L</a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
@endsection

