@extends('mainlayout.master')

@section('title', 'Akademik Personel')
@section('description','')
@section('content')
  <section class="pager-section">
        <div class="container">
            <div class="pager-content text-center">
                <h2>{{__('messages.Teachers')}}</h2>
                <ul>
                    <li><a href="{{ route('home') }}" title="">{{__('messages.Home')}}</a></li>
                    <li><span>{{__('messages.Teachers')}}</span></li>
                </ul>
            </div><!--pager-content end-->
            <h2 class="page-titlee">KAEU | BMB</h2>
        </div>
    </section><!--pager-section end-->

    <section class="page-content">
        <div class="container">
            <div class="teachers-section p-0">
                <div class="teachers">
                    <div class="row">
                        @foreach($akademikPersoneller as $personel)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12 full-wdth">
                                <div class="teacher">
                                    <a href="{{ route('academic-staff-details', $personel->id) }}" title="">
                                    <div class="teacher-img">
                                        <img src="{{ asset('storage/' . $personel->personel_img) }}" alt="" class="w-100">
                                    </div>
                                    </a>
                                    <div class="teacher-info">
                                        <h3><a href="{{ route('academic-staff-details', $personel->id) }}" title="">{{ $personel->personel_isim_soyisim }}</a></h3>
                                        <span>{{ $personel->getUnvan(app()->getLocale()) }}    @if($personel->getGorev(app()->getLocale()))
                                                - {{ $personel->getGorev(app()->getLocale()) }}
                                            @endif</span>
                                    </div>
                                </div><!--teacher end-->
                            </div>
                        @endforeach
                    </div>
                </div><!--teachers end-->
            </div><!--teachers-section end-->
        </div>
    </section><!--page-content end-->

@endsection
