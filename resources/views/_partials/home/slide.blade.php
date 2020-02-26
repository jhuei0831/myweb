@if(isset($current_page) && $current_page->is_slide == '1' || Request::path() == '/' || Request::path() == '/home')
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
                <a href="{{ $slide->link }}"><img class="d-block img-full" src="{{ asset('/images/slide/'.$slide->image) }}" alt="{{ $slide->name }}"></a>
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
@endif