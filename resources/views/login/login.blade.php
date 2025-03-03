@extends('adminlayout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12 ps-md-0 m-auto">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2"><span>KAEU-BMB</span> Yönetim Paneli</a>
                                <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-Posta Adresiniz</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Şifreniz</label>
                                        <input type="password" class="form-control" id="userPassword"
                                               autocomplete="current-password" placeholder="Şifreniz" name="password">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
