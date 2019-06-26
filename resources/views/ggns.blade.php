@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-bottom:20px">
            
                    <div class="card-body">
    
                        @if (isset($var['ggn_edit']))
                            <form method="POST" action="/ggn/{{$var['ggn_edit']->ggn}}" > @method('put')
                        @else
                            <form method="POST" action="/ggn">
                        @endif
    
                            @csrf
                            <div class="form-row">
                                <div class="col-md-5">
                                    <input id="focus" min="1" max="9999999999999" @if (isset($var['ggn_edit'])) value="{{$var['ggn_edit']->ggn}}" @endif type="number"  class="form-control form-control-sm" name="ggn" placeholder="GGN" required>
                                </div>
                                <div class="col-md-5">
                                    <input @if (isset($var['ggn_edit'])) value="{{$var['ggn_edit']->erzeuger}}" @endif type="text" class="form-control form-control-sm" name="erzeuger" placeholder="Erzeuger">
                                </div>
                                <div class="col-md-2" style="text-align:right">
                                    <button type="submit" class="btn btn-primary btn-sm"> @if (isset($var['ggn_edit'])) aktualisieren @else hinzufügen @endif </button>
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
                                    <th scope="col">GGN</th>
                                    <th scope="col">Erzeuger</th>
                                    <th scope="col" style="text-align:right">Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($var['ggns'] as $ggn)
                                <tr>
                                    <td>{{$ggn->ggn}}</td>
                                    <td>{{$ggn->erzeuger}}</td>
                                    <td style="text-align:right">
                                        <a href="/ggn/{{$ggn->ggn}}/edit">B</a>
                                        <a href="#" onclick="del_data('ggn', '{{$ggn->ggn}}', '{{$ggn->erzeuger}}')">L</a>
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
window.onload = function() {
  document.getElementById("focus").focus();
  console.log('asdasd');
};
</script>

@endsection
