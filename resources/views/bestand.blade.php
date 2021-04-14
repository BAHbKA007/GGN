@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card" style="margin-bottom:20px">
                <div class="card-body">
                    <form method="GET" action="/show_bestand">
                        <div class="form-row">
                            <div class="col-md-12">
                                <input 
                                    class="form-control form-control-lg" 
                                    type="date" 
                                    id="datepicker" 
                                    name="datum"
                                    value=""
                                    onchange="this.form.submit()">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (isset($var['bestand']))
                asdasds
            @endif

        </div>
    </div>
</div>

@endsection
