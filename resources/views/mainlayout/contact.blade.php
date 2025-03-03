@extends('mainlayout.master')
@section('title', __('messages.Contact'))
@section('description','')
@section('content')
    <section class="pager-section">
        <div class="container">
            <div class="pager-content text-center">
                <h2>{{__('messages.Contact')}}</h2>
                <ul>
                    <li><a href="#" title="">{{__('messages.Home')}}</a></li>
                    <li><span>{{__('messages.Contact')}}</span></li>
                </ul>
            </div><!--pager-content end-->
            <h2 class="page-titlee">
                KAEU | BMB
            </h2>
        </div>
    </section><!--pager-section end-->

    <section class="page-content">
        <div class="container">
            <div class="mdp-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3094.4129464452117!2d34.11725207575103!3d39.14258837167276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d50d492db57789%3A0x7f131464dc8c810c!2zTcO8aGVuZGlzbGlrIE1pbWFybMSxayBGYWvDvGx0ZXNp!5e0!3m2!1str!2str!4v1740969856280!5m2!1str!2str"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!--mdp-map end-->
            <div class="mdp-contact">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="comment-area">
                            <h3>{{__('messages.Mesaj Gönder')}}</h3>
                            <form id="contact-form" method="post" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="response"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="name"
                                                   placeholder="{{__('messages.Adınız ve Soyadınız')}}" required>
                                        </div><!--form-group end-->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="email"
                                                   placeholder="{{__('messages.Email')}}" required>
                                        </div><!--form-group end-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" name="subject" class="subject"
                                                   placeholder="{{__('messages.Konu')}}" required>
                                        </div><!--form-group end-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea name="message"
                                                      placeholder="{{__('messages.Mesajınız')}}"></textarea>
                                        </div><!--form-group end-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-submit">
                                            <button type="submit" id="submit" class="btn-default gonder">{{__('messages.Gönder')}} <i class="fa fa-long-arrow-alt-right"></i></button>
                                        </div><!--form-submit end-->
                                    </div>
                                </div>
                            </form>
                        </div><!--comment-area end-->
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="mdp-our-contacts">
                            <h3>{{__('messages.Our Contacts')}}</h3>
                            <ul>
                                <li>
                                    <div class="d-flex flex-wrap">
                                        <div class="icon-v">
                                            <img src="../../../public/mainassets/assets/img/icon15.png" alt="">
                                        </div>
                                        <div class="dd-cont">
                                            <h4>{{__('messages.Call')}}</h4>
                                            <span>+90 386 280 38 00</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex flex-wrap">
                                        <div class="icon-v">
                                            <img src="../../../public/mainassets/assets/img/icon16.png" alt="">
                                        </div>
                                        <div class="dd-cont">
                                            <h4>{{__('messages.Adres')}}</h4>
                                            <span>Bağbaşı Mah. Sahir Kurutluoğlu Cad. No: 100 Merkez / KIRŞEHİR</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex flex-wrap">
                                        <div class="icon-v">
                                            <img src="../../../public/mainassets/assets/img/icon17.png" alt="">
                                        </div>
                                        <div class="dd-cont">
                                            <h4>{{__('messages.Email')}}</h4>
                                            <span>bilmuh@ahievran.edu.tr</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!--mdp-our-contacts end-->
                    </div>
                </div>
            </div><!--mdp-contact end-->
        </div>
    </section><!--page-content end-->
@endsection
@push('custom')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            console.log('Document ready');
            $('#submit').click(function (e) {
                e.preventDefault(); // Formun otomatik submit olmasını engelle
                console.log('Submit button clicked');

                var name = $('.name').val();
                var email = $('.email').val();
                var subject = $('.subject').val();
                var message = $('textarea').val();

                if (name == '' || email == '' || subject == '' || message == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{__('messages.Lütfen tüm alanları doldurunuz')}}',
                    });
                } else {
                    console.log('Sending AJAX request');
                    $.ajax({
                        url: '{{route('contact.store')}}',
                        type: 'POST',
                        data: {
                            name: name,
                            email: email,
                            subject: subject,
                            message: message,
                            _token: '{{csrf_token()}}'
                        },
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: '{{__('messages.Başarılı')}}',
                                text: '{{__('messages.Mesajınız başarıyla gönderildi')}}',
                            }).then(() => {
                                $('.name').val('');
                                $('.email').val('');
                                $('.subject').val('');
                                $('textarea').val('');
                            });
                        },
                        error: function(xhr) {
                            console.error('AJAX Error:', xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{__('messages.Bir hata oluştu, lütfen tekrar deneyiniz')}}',
                            });
                        }
                    });
                }
            });
        });

    </script>
@endpush
