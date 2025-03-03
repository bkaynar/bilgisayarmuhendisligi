@extends('mainlayout.master')

<!-- title unvan + isim soyisim -->
@section('title', $personel->getUnvan(app()->getLocale()) . ' ' . $personel->personel_isim_soyisim)
@section('description','')
@section('content')
    <section class="pager-section">
        <div class="container">
            <div class="pager-content text-center">
                <h2>{{$personel->getUnvan(app()->getLocale())}}
                    {{ $personel->personel_isim_soyisim }}
                    @if($personel->getGorev(app()->getLocale()))
                        - {{ $personel->getGorev(app()->getLocale()) }}
                    @endif

                </h2>
                <ul>
                    <li><a href="{{ route('home') }}" title="">{{__('messages.Home')}}</a></li>
                    <li><a href="{{ route('academic-staff') }}" title="">{{__('messages.Teachers')}}</a></li>
                    <li><span>{{ $personel->personel_isim_soyisim }}
                            @if($personel->getGorev(app()->getLocale()))
                                - {{ $personel->getGorev(app()->getLocale()) }}
                            @endif                                </span></li>
                </ul>
            </div><!--pager-content end-->
            <h2 class="page-titlee">KAEU | BMB</h2>
        </div>
    </section><!--pager-section end-->

    <section class="page-content">
        <div class="container">
            <div class="teacher-single-page">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="teacher-coly">
                            <img src="{{ asset('storage/' . $personel->personel_img) }}" alt="">
                        </div><!--teacher-coly end-->
                    </div>
                    <div class="col-lg-8">
                        <div class="teacher-content">
                            <h3>{{ $personel->getUnvan(app()->getLocale()) }} {{ $personel->personel_isim_soyisim }}@if($personel->getGorev(app()->getLocale()))
                                    - {{ $personel->getGorev(app()->getLocale()) }}
                                @endif</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-6">
                                    <div class="rol-z">
                                        <img src="{{ asset('mainassets/assets/img/telefon.png') }}" alt="">
                                        <div class="rol-info">
                                            <h3>{{__('messages.Call')}}</h3>
                                            <span>{{ $personel->personel_telefon }}</span>
                                        </div>
                                    </div><!--rol-z end-->
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-6">
                                    <div class="rol-z">
                                        <img src="{{ asset('mainassets/assets/img/email.png') }}" alt="">
                                        <div class="rol-info">
                                            <h3>{{__('messages.Email')}}</h3>
                                            <span>{{ $personel->personel_email }}</span>
                                        </div>
                                    </div><!--rol-z end-->
                                </div>
                            </div>
                            <p>{{ $personel->getHakkinda(app()->getLocale()) }}</p>
                        </div><!--teacher-content end-->
                    </div>
                </div>
            </div><!--teacher-single-page end-->
            <div class="teachers-section teacher-page">
                <div class="section-title text-center">
                    <h2>{{__('messages.Other Teachers')}}</h2>
                </div><!--section-title end-->
                <div class="teachers">
                    <div class="row">
                        @foreach($otherTeachers as $other)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6 full-wdth">
                                <div class="teacher">
                                    <a href="{{ route('academic-staff-details', $other->id) }}" title="">
                                        <div class="teacher-img">
                                            <img src="{{ asset('storage/' . $other->personel_img) }}" alt="" class="w-100">
                                        </div>
                                    </a>
                                    <div class="teacher-info">
                                        <h3><a href="{{ route('academic-staff-details', $other->id) }}"
                                               title="">{{ $other->personel_isim_soyisim }}</a></h3>
                                        <span>{{ $other->getUnvan(app()->getLocale()) }}</span>
                                    </div>
                                </div><!--teacher end-->
                            </div>
                        @endforeach
                    </div>
                </div><!--teachers end-->
            </div>
        </div>
    </section><!--page-content end-->

@endsection
