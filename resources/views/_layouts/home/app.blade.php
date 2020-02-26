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

        <main class="py-4" >
            @yield('content')
        </main>
    </div>
</body>
</html>
