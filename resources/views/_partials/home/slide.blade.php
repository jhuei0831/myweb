@if($current_page->is_slide == '1' && $current_page->url == Request::path())
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
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