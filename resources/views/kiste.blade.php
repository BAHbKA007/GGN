@extends('layouts.app')

@section('content')

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
                            <div class="col-md-7">
                                <input id="focus" @if (isset($var['kiste_edit'])) value="{{$var['kiste_edit']->bezeichnung}}" @endif type="text" class="form-control form-control-sm" name="bezeichnung" placeholder="Bezeichnung" required>
                            </div>
                            <div class="col-md-2" style="text-align:right">
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
@endsection
