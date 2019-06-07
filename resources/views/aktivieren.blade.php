@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Aktivierung erforderlich!</div>

                <div class="card-body">
                    Hallo {{Auth::user()->name}},
                    <p>Ihr Benutzer muss noch vom Qualitätsmanagement aktiviert werden.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
