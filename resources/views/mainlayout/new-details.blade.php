@extends('mainlayout.master')

@section('title', $haber->getTranslation(app()->getLocale())->haber_baslik)
@section('description', Str::limit($haber->getTranslation(app()->getLocale())->haber_icerik, 150))
@section('content')
    <section class="pager-section blog-version" style="background-image: url('{{ asset( $haber->haber_resim) }}');">
        <div class="container">
            <div class="pager-content text-center">
                <ul>
                    <li><a href="{{ route('home') }}" title="">{{ __('messages.Home') }}</a></li>
                    <li><a href="{{ route('news') }}" title="">{{ __('messages.News') }}</a></li>
                    <li><span>{{ $haber->getTranslation(app()->getLocale())->haber_baslik }}</span></li>
                </ul>
                <h2>{{ $haber->getTranslation(app()->getLocale())->haber_baslik }}</h2>
                <ul class="meta">
                    <li><a href="#" title="">{{ $haber->yayin_tarihi }}</a></li>
                </ul>
            </div><!--pager-content end-->
        </div>
    </section><!--pager-section end-->

    <section class="page-content p80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-post single">
                        <p>{!! $haber->getTranslation(app()->getLocale())->haber_icerik !!}</p>

                    </div><!--blog-post single end-->
                </div>
            </div>
        </div>
    </section>
@endsection
