@extends('adminlayout.master')
@section('title', 'Mesajlar')
@section('content')
    <div class="row inbox-wrapper">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="text-body"><strong>Gönderen Adı: {{$mesaj->name}}</strong></a>
                                    </div>
                                </div>
                                <div class="tx-13 text-muted mt-2 mt-sm-0">{{ $mesaj->created_at->format('d-m-Y H:i')}}</div>
                            </div>
                            <div class="p-4 border-bottom">
                             <b>Mesaj: </b>{{ $mesaj->message}}
                            </div>
                            <div class="p-4 border-bottom">
                                <p>
                                    Email:<strong>{{$mesaj->email}}</strong>
                                </p>
                                <p>
                                    Konu:<strong>{{$mesaj->subject}}</strong>
                                </p>
                                <p>
                                    IP Adresi:<strong>{{$mesaj->ip_address}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
