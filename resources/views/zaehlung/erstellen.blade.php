@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="col-md-12 text-center"> 
        <form action="/zaehlung/neu" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Neue Zählung</button>
        </form>
    </div>
</div>
@endsection