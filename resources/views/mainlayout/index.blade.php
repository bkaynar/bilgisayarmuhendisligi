@extends('mainlayout.master')
@section('content')
    <x-slider-component/>
    <section class="blog-section">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{__('messages.Son Haberler')}}</h2>
                <p>

            </div><!--section-title end-->
            <x-index-haber-component/>
        </div>
    </section><!--blog-section end-->
    <x-hakkimizda-component/>
    <section class="blog-section">
    <x-hedef-component/>
    </section>

@endsection
