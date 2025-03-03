<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Bilgisayar Mühendisliği Bölümü Yönetim Paneli</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->


    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('adminassets/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet"/>
    <link href="{{ asset('adminassets/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('adminassets/css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/')}}">

<script src="{{ asset('adminassets/assets/js/spinner.js') }}"></script>

<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
        @yield('content')
    </div>
</div>

<!-- base js -->
<script src="{{ asset('adminassets/js/app.js') }}"></script>
<script src="{{ asset('adminassets/assets/plugins/feather-icons/feather.min.js') }}"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('adminassets/assets/js/template.js') }}"></script>
<!-- end common js -->

@stack('custom-scripts')
</body>
</html>
