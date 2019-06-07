@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card" style="margin-bottom:20px">
                <div class="card-header bg-primary text-white">neues Programm erstellen</div>
                <div class="card-body">
                    <form method="POST" action="/programm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="von">von:</label>
                                <input type="date" class="form-control form-control-sm" name="von" placeholder="von z.B. '2019-12-31'" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bis">bis:</label>
                                <input type="date" class="form-control form-control-sm" name="bis" placeholder="bis z.B. '2019-12-31'" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">erstellen</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection