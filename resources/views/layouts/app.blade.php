<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=200, initial-scale=1.5, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="apple-touch-startup-image" href="{{Request::root()}}/img/favicon-192.png">
    <meta name="apple-mobile-web-app-title" content="QM GGN">
    <link
        rel="apple-touch-startup-image"
        media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{Request::root()}}/img/splash.jpg"
    />

    <!-- iPhone 8, 7, 6s, 6 (750px x 1334px) --> 
    <link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" href="{{Request::root()}}/img/splash_iphone.jpg">  

    <!-- ****** faviconit.com Favicons ****** -->
	<link rel="shortcut icon" href="{{Request::root()}}/img/favicon.ico">
	<link rel="icon" sizes="16x16 32x32 64x64" href="{{Request::root()}}/img/favicon.ico">
	<link rel="icon" type="image/png" sizes="196x196" href="{{Request::root()}}/img/favicon-192.png">
	<link rel="icon" type="image/png" sizes="160x160" href="{{Request::root()}}/img/favicon-160.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{Request::root()}}/img/favicon-96.png">
	<link rel="icon" type="image/png" sizes="64x64" href="{{Request::root()}}/img/favicon-64.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{Request::root()}}/img/favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{Request::root()}}/img/favicon-16.png">
	<link rel="apple-touch-icon" href="{{Request::root()}}/img/favicon-57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="{{Request::root()}}/img/favicon-114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="{{Request::root()}}/img/favicon-72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="{{Request::root()}}/img/favicon-144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="{{Request::root()}}/img/favicon-60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="{{Request::root()}}/img/favicon-120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="{{Request::root()}}/img/favicon-76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="{{Request::root()}}/img/favicon-152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="{{Request::root()}}/img/favicon-180.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="/img/favicon-144.png">
	<meta name="msapplication-config" content="/img/browserconfig.xml">
	<!-- ****** faviconit.com Favicons ****** -->
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v=0.6"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v=0.6" rel="stylesheet">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" onClick="window.location.reload();" href="{{ url('/') }}">
                    {{ config('app.name', 'QM') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (Auth::user() != NULL && Auth::user()->role != 1)
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item dropdown">
                                <a 
                                id="navbarDropdown" 
                                class="nav-link dropdown-toggle" 
                                href="#" 
                                role="button" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false" 
                                v-pre>Stammdaten<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/artikel">Artikel</a>
                                    <a class="dropdown-item" href="/kunden">Kunden</a>
                                    <a class="dropdown-item" href="/ggn">GGNs</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/benutzer">Benutzer</a>
                               </div>
                           </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/programm">Programme</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/zaehlung">Zählungen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/suche">Suche</a>
                            </li>
                        </ul>
                        <!-- Left Side Of Navbar -->

                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                            </li>
                        @else
                            {{-- <a href="/sync" class="btn btn-light" role="button">GLOBALG.A.P. Sync.</a> --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

@if (Auth::check()) 

    @if (Auth::user()->role == 1)
        <script>
            var a=document.getElementsByTagName("a");
            for(var i=0;i<a.length;i++)
            {
                a[i].onclick=function()
                {
                    window.location=this.getAttribute("href");
                    return false
                }
            }

        </script>
    @endif
    
@endif

<script>
    $('#lodingButton').click(function(){
        $('#btn-txt').text('Lade...');
        $('#spinner').show();
        $('#lodingButton').attr("disabled", true);
        $('#'+$(this).data("form")).submit();
    
    });
</script>
</body>
</html>
