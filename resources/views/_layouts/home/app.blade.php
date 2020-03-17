
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')::{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">

        {{-- swiper cdn --}}
        <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    </head>
    @if($config->background == 'background.jpg')
    <body style="background-image: url('{{ asset('images/background.jpg')}}');background-size:cover; background-attachment: fixed; background-repeat: no-repeat;">
    @else
    <body style="background:linear-gradient(#{{ $config->background_color }}, #FFFFFF); background-size:cover; background-attachment: fixed; background-repeat: no-repeat;">
    @endif
        {{-- loading --}}
        <div class="se-pre-con"></div>
        <div style="font-size:{{ $config->font_size }};font-weight:{{ $config->font_weight }};font-family: {{ $config->font_family }};">
            @include('_partials.home.nav')
            @include('_partials.home.slide')

            <main class="py-4" >
                <div class="container-fluid">
                    <div class="row justify-content-center" >
                    @include('_partials.home.notice')
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
        <script src="https://unpkg.com/swiper/js/swiper.js"></script>
        <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
        <script>
            $(document).ready(function(){
              $('.owl-carousel').owlCarousel({
                    items:1,
                    margin:10,
                    loop:true,
                    // autoHeight:true,
                    autoplay:true,
                    autoplayTimeout:3000,
                    autoplayHoverPause:true
                });
            });
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");;
            });
            $(document).ready(function() {
                var toggleAffix = function(affixElement, scrollElement, wrapper) {
                var height = affixElement.outerHeight(),
                    top = wrapper.offset().top;
                    if (scrollElement.scrollTop() >= top){
                        wrapper.height(height);
                        affixElement.addClass("affix");
                    }
                    else {
                        affixElement.removeClass("affix");
                        wrapper.height('auto');
                    }
                };
                $('[data-toggle="affix"]').each(function() {
                    var ele = $(this),
                    wrapper = $('<div></div>');
                    ele.before(wrapper);
                    $(window).on('scroll resize', function() {
                        toggleAffix(ele, $(this), wrapper);
                    });
                    // init
                    toggleAffix(ele, $(window), wrapper);
                });

            });
            var mySwiper = new Swiper ('.swiper-container', {
                // Optional parameters
                loop: true,
                autoHeight: true, //enable auto height
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                // If we need pagination
                pagination: {
                el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                },
            })
        </script>
        @show
    </body>
     @include('_partials.home.footer')
</html>
