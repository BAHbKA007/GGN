@extends('layouts.app')

@section('content')
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
                                    <input @if (isset($var['kunden_edit'])) value="{{$var['kunden_edit']->name}}" @endif type="text" class="form-control form-control-sm" name="name" placeholder="Kunde" required>
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
                                    <td style="text-align:right"><a href="/kunden/{{$kunde->id}}/edit">B</a> <a href="#" onclick="del_data('kunden', '{{$kunde->id}}', '{{$kunde->name}}')">L</a></td>
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
