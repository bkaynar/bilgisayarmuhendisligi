@extends('mainlayout.master')

@section('title', __('messages.Laboratories'))
@section('description','')
@section('content')
    <section class="pager-section">
        <div class="container">
            <div class="pager-content text-center">
                <h2>{{__('messages.Classes')}}</h2>
                <ul>
                    <li><a href="#" title="">{{__('messages.Home')}}</a></li>
                    <li><span>{{__('messages.Classes')}}</span></li>
                </ul>
            </div><!--pager-content end-->
            <h2 class="page-titlee">KAEU | BMB</h2>
        </div>
    </section><!--pager-section end-->

    <section class="classes-page">
        <div class="container">
            <div class="classes-section">
                <div class="classes-sec">
                    <div class="row">
                        @foreach($laboratuvarlar as $laboratuvar)
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <div class="classes-col">
                                    <div class="class-thumb">
                                        <img src="{{$laboratuvar->lab_resim}}" alt="" class="w-100">
                                    </div>
                                </div><!--classes-col end-->
                            </div>
                        @endforeach
                    </div>
                </div><!--classes-sec end-->
            </div>
        </div>
    </section><!--classes-page end-->

@endsection
