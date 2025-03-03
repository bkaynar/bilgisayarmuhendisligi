@foreach($hakkimizda as $hakkimizda)
<section class="about-page-content">
    <div class="container">
        <div class="abt-page-row">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="avt-img">
                        <img src="{{asset('mainassets/assets/img/mmf.jpg')}}" alt="">
                    </div><!--avt-img end-->
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="act-inffo">
                        <h2>{{$hakkimizda->getBaslik()}}</h2>
                        {!! $hakkimizda->getIcerik() !!}
                    </div><!--act-inffo end-->
                </div>
            </div>
        </div><!--abt-page-row end-->
    </div>
</section>
@endforeach
