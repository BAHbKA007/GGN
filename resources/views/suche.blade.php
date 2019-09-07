@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card" style="margin-bottom:20px">
                
                <div class="card-body">
                    <form method="POST" action="/suche">
                        @csrf

                        <div class="form-group">
                            <input id="focus" type="text" class="form-control form-control-sm" name="suche" placeholder='GGN oder Namen oder nur Teile mit Leerzeichen dazwischen eingeben z.B. "40 290" ...' required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">suchen</button>
                    </form>
                </div>
                
            </div>
            @if (isset($var['positionen']))
                <ul class="list-group">

                    @foreach ($var['positionen'] as $item)

                        <li class="list-group-item">
            
                            @php
                                if( $item->grasp_status == NULL ){
                                    $farbe = 'warning';
                                } elseif ( ( isset($item->grasp_valid_to_current) ) && ( strtotime($item->grasp_valid_to_current) < time() || strtotime($item->artikel_datum) < time() ) ) {
                                    $farbe = 'danger';
            
                                } else {
                                    $farbe = 'success';
                                }
                            @endphp
            
                            <button class="btn btn-{{$farbe}}" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapse">
                                {{$item->ggn}}
                            </button>
                            <span style="margin-left:10px">
                                 ( {{$item->erzeuger}} 
                                 | {{$item->country}}
                                 | {{$item->company_type}} 
                                 | GRASP: @if (isset($item->grasp_status)) {{$item->grasp_status}} bis {{strftime("%d.%m.%Y", strtotime($item->grasp_valid_to_current))}} @else NEIN @endif
                                 @if (isset($item->groupggn)) | Gruppe: {{$item->groupggn}} @endif )
                            </span>
                            <div class="collapse" id="collapse{{$item->id}}">
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
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        document.getElementById("focus").focus();
    };
</script>
@endsection
