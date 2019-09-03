<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=600, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kommentare</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        <main class="py-4">
            <div class="list-group">

                @foreach ($var['kommentare'] as $item)
                    <a class="list-group-item list-group-item-action flex-column align-items-start" @if ($item->erledigt == 1) style="background-color: #ffd7d7;" @endif>
                        <div class="d-flex w-100 justify-content-between">
                            <h4 class="mb-1">{{$item->kunde}}</h4>
                            <small>{{$item->name}} am {{strftime("%d.%m.%Y", strtotime($item->updated_at))}} um {{strftime("%H:%M", strtotime($item->updated_at))}}</small>
                        </div>
                        <p class="mb-1">{!! nl2br($item->comment)!!}</p>
                        <form action="/comment/erledigen" method="post">
                            @csrf
                            <input id="id" type="hidden" name="id" value="{{$item->id}}">
                            @if ($item->erledigt == 1) 
                                <button type="submit" class="btn btn-success float-right">erledigen</button> 
                            @else
                                <button type="submit" class="btn btn-danger float-right">unerledigt markieren</button> 
                            @endif
                        </form>
                    </a>
                @endforeach

            </div>
        </main>
    </div>
</body>
<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
</html>