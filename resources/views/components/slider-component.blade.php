<section class="main-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($sliders as $index => $slider)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img  src="@if($slider->slider_url){{ asset($slider->slider_url) }}@endif"
                         class="d-block w-100 custom-height slider-resim" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slider-baslik">{{$slider->getUstmetin()}}</h1>
                        <p class="slider-icerik">{{$slider->getAltmetin()}}</p>
                        @if($slider->slider_link)
                            <a href="{{$slider->slider_link}}" class="btn-default">
                                {{__('messages.Daha Fazla')}}
                                <i class="fa fa-long-arrow-alt-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section><!--main-banner end-->
