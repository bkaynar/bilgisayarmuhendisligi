<!-- File: resources/views/components/index-haber-component.blade.php -->
<div class="blog-posts">
    <div class="row">
        @foreach($haberler as $haber)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumbnail">
                        <img src="{{ asset('storage/' . $haber->haber_resim) }}" alt="" class="w-100">
                    </div>
                    <div class="blog-info">
                        <ul class="meta">
                            <li><a href="#" title="">{{ $haber->yayin_tarihi }}</a></li>

                        </ul>
                        <h3><a href="{{ route('habers.show', $haber->id) }}"
                               title="">{{ $haber->getTranslation(app()->getLocale())->haber_baslik }}</a></h3>
                        <p>{!! Str::limit($haber->getTranslation(app()->getLocale())->haber_icerik, 150) !!}</p>
                        <a href="{{ route('habers.show', $haber->id) }}" title="" class="read-more">{{__('messages.Oku')}} <i
                                class="fa fa-long-arrow-alt-right"></i></a>
                    </div>
                </div><!--blog-post end-->
            </div>
        @endforeach
    </div>
</div><!--blog-posts end-->
