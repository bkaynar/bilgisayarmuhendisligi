@extends('mainlayout.master')
                        @section('content')

                            <section class="pager-section">
                                <div class="container">
                                    <div class="pager-content text-center">
                                        <h2>{{ __('messages.News') }}</h2>
                                        <ul>
                                            <li><a href="#" title="">{{__('messages.Home')}}</a></li>
                                            <li><span>{{ __('messages.News') }}</span></li>
                                        </ul>
                                    </div><!--pager-content end-->
                                    <h2 class="page-titlee">
                                        KAEU | BMB
                                    </h2>
                                </div>
                            </section><!--pager-section end-->

                            <section class="page-content">
                                <div class="container">
                                    <div class="row d-flex flex-wrap">
                                        @foreach($haberler as $haber)
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="blog-section p-0 posts-page">
                                                    <div class="blog-posts">
                                                        <div class="blog-post">
                                                            <div class="blog-thumbnail">
                                                                <a href="{{ route('haber.show', $haber->id) }}" title="">
                                                                    <img src="{{ asset('storage/' . $haber->haber_resim) }}" alt="">
                                                                </a>
                                                                <span
                                                                    class="category">{{ $haber->getTranslation(app()->getLocale())->haber_baslik }}</span>
                                                            </div>
                                                            <div class="blog-info">
                                                                <ul class="meta">
                                                                    <li><a href="#" title="">{{ $haber->yayin_tarihi }}</a></li>
                                                                </ul>
                                                                <h3><a href="{{ route('habers.show', $haber->id) }}"
                                                                       title="">{{ $haber->getTranslation(app()->getLocale())->haber_baslik }}</a>
                                                                </h3>
                                                                <p>{!! Str::limit($haber->getTranslation(app()->getLocale())->haber_icerik, 150) !!}</p>
                                                                <a href="{{ route('habers.show', $haber->id) }}" title="" class="read-more">{{__('messages.Oku')}}
                                                                    <i class="fa fa-long-arrow-alt-right"></i></a>
                                                            </div>
                                                        </div><!--blog-post end-->
                                                    </div><!--blog-posts end-->
                                                </div><!--blog-section end-->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section><!--page-content end-->

                        @endsection
