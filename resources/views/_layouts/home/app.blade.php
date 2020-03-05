<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')::{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    @if($config->background == 'background.jpg')
    <body style="background-image: url('{{ asset('images/background.jpg')}}');background-size:cover; background-attachment: fixed; background-repeat: no-repeat;">
    @else
    <body style="background:linear-gradient(#{{ $config->background_color }}, #FFFFFF); background-size:cover; background-attachment: fixed; background-repeat: no-repeat;">
    @endif
        <div id="app" style="font-size:{{ $config->font_size }};font-weight:{{ $config->font_weight }};font-family: {{ $config->font_family }};">
            @include('_partials.home.nav')
            @include('_partials.home.slide')

            <main class="py-2" >
                <div class="container-fluid">
                    <div class="row justify-content-center" >
                    @yield('menu')
                    @yield('content')
                    </div>
                </div>
            </main>
           
        </div>
        @section('script')
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.0.4/jscolor.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
        @show
    </body>
     @include('_partials.home.footer')
</html>
