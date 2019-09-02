@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    {{-- <p><a href="/zaehlung/{{$var['id']}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a> / <a href="#">?</a></p> --}}

    <ul class="list-group">

        @foreach ($var['positionen'] as $item)
            <li class="list-group-item">        
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$item->z_id}}" aria-expanded="false" aria-controls="collapse">
                    {{$item->ggn}}
                </button>
            <span style="margin-left:10px"><b>{{$item->menge}}</b> {{$item->bezeichnung}} <small>({{$item->erzeuger}})</small> </span>
                <div class="collapse" id="collapse{{$item->z_id}}">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </li>
        @endforeach

    </ul>
</div>
@endsection