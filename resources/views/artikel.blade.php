@extends('layouts.app')

@section('content')
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
                                <input id="focus" @if (isset($var['artikel_edit'])) value="{{$var['artikel_edit']->bezeichnung}}" @endif type="text" class="form-control form-control-sm" name="bezeichnung" placeholder="Artikelbezeichnung" required>
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
                                    {{$artikel->bezeichnung}}
                                </td>
                                <td style="text-align:right">
                                    <a href="/artikel/{{$artikel->id}}/edit"><i class="material-icons" style="font-size:16px">create</i></a>
                                    <a href="#" onclick="del_data('artikel', '{{$artikel->id}}', '{{$artikel->bezeichnung}}')"><i class="material-icons" style="font-size:16px">delete_outline</i></a>
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
