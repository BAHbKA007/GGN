@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    {{-- <p><a href="/zaehlung/{{$var['id']}}">{{$wochentag[strftime("%u", strtotime($var['zaehlung']->created_at))]}}</a> / <a href="#">?</a></p> --}}

    <ul class="list-group">

        @foreach ($var['positionen'] as $item)
        @if ($var != $item->name )
            <h4 style="margin-top:20px">{{$item->name}}:</h4>            
        @endif
            <li class="list-group-item">

                @php
                    if( $item->grasp_status == NULL ){
                        $farbe = 'warning';
                    } elseif (strtotime($item->grasp_valid_to_current) < time() ) {
                        $farbe = 'danger';

                    } else {
                        $farbe = 'success';
                    }
                @endphp

                <button class="btn btn-{{$farbe}}" type="button" data-toggle="collapse" data-target="#collapse{{$item->z_id}}" aria-expanded="false" aria-controls="collapse">
                    {{$item->ggn}}
                </button>
                <span style="margin-left:10px"><small>( {{$item->erzeuger}} | GRASP: @if (isset($item->grasp_status)) {{$item->grasp_status}} bis {{strftime("%d.%m.%Y", strtotime($item->grasp_valid_to_current))}} @endif)</small></span>
                <div class="collapse" id="collapse{{$item->z_id}}">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Artikel</th>
                                <th scope="col">Status</th>
                                <th scope="col">aktueller Zyklus</th>
                                <th scope="col">nächster Zyklus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->artikel as $artikel)
                                <tr @if ( ($artikel->valid_to_current != NULL && strtotime($artikel->valid_to_current) < time()) || $artikel->valid_to_current != NULL && strtotime($artikel->valid_to_current) < time()) style="background-color:#FF6347" @endif>
                                    <td>{{$artikel->product_name}}</td>
                                    <td>{{$artikel->product_status}}</td>
                                    <td>@if ($artikel->valid_to_current != NULL) {{strftime("%d.%m.%Y", strtotime($artikel->valid_to_current))}} @endif</td>
                                    <td>@if ($artikel->valid_to_next != NULL) {{strftime("%d.%m.%Y", strtotime($artikel->valid_to_next))}} @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
            @php
                $var = $item->name;
            @endphp
        @endforeach

    </ul>
</div>
@endsection