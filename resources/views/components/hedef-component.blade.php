<div class="about-sec">
    <div class="container">
        <div class="row">
            @foreach($hedefler as $hedef)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="abt-col wow fadeInUp" data-wow-duration="1000ms">
                        <img src="{{asset('mainassets/assets/img/icon8.png')}}" alt="">
                        <h3 class="hedef-icerik" >{{ $hedef->getTranslation(app()->getLocale())->hedef_baslik }}</h3>
                        <p>{{ $hedef->getTranslation(app()->getLocale())->hedef_icerik }}</p>
                    </div><!--abt-col end-->
                </div>
            @endforeach
        </div>
    </div>
</div><!--about-rw end-->
