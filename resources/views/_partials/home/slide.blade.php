{{-- Bootstrap --}}
{{-- @if(count($slides) > 0 && (isset($current_page) && $current_page->is_slide == '1' || Request::path() == '/'))
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
        @for ($i = 1; $i < count($slides); $i++)
            <li data-target="#carouselExampleControls" data-slide-to="$i"></li>
        @endfor
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach( $slides as $slide )
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" align="center">
                <a href="{{ $slide->link ?? '#' }}"><img class="img-fluid" src="{{ $slide->image }}" alt="{{ $slide->name }}"></a>
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif --}}

{{-- Swiper --}}
{{-- @if(count($slides) > 0 && (isset($current_page) && $current_page->is_slide == '1' || Request::path() == '/'))
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach ($slides as $slide)
            <div class="swiper-slide">
                 <a href="{{ $slide->link ?? '#' }}"><img class="img-fluid" src="{{ $slide->image }}" alt="{{ $slide->name }}"></a>
            </div>
        @endforeach
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
@endif --}}

{{-- Owl --}}
@if(count($slides) > 0 && (isset($current_page) && $current_page->is_slide == '1' || Request::path() == '/'))
<div class="container-fluid">
    <div class="row">
        <div class="owl-carousel owl-theme owl-dots-inner col-md-8">
            @foreach ($slides as $slide)
                <div>
                    <a href="{{ $slide->link ?? '#' }}"><img class="img-fluid" src="{{ $slide->image }}" alt="{{ $slide->name }}"></a>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div> col-md-4 </div>
        </div>
    </div>
</div>
@endif
