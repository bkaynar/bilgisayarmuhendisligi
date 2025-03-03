<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- sayfadaki ilk h6 etiketi içeriğini alır ve sayfa başlığı olarak kullanır -->
    <title>@yield('title', 'Yönetim Paneli') | Bilgisayar Mühendisliği Bölümü</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('favico.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('adminassets/assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet"/>
    <link href="{{ asset('adminassets/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('adminassets/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />

    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('adminassets/css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/admin')}}">

<script src="{{ asset('adminassets/assets/js/spinner.js') }}"></script>

<div class="main-wrapper" id="app">
    @include('adminlayout.sidebar')
    <div class="page-wrapper">
        @include('adminlayout.header')
        <div class="page-content">
            @yield('content')
        </div>
        @include('adminlayout.footer')
    </div>
</div>

<!-- base js -->
<script src="{{ asset('adminassets/js/app.js') }}"></script>
<script src="{{ asset('adminassets/assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('adminassets/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.min.js" integrity="sha512-Ozu7Km+muKCuIaPcOyNyW8yOw+KvkwsQyehcEnE5nrr0V4IuUqGZUKJDavjSCAA/667Dt2z05WmHHoVVb7Bi+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('adminassets/assets/js/template.js') }}"></script>
<!-- end common js -->
<script src="{{ asset('adminassets/assets/js/data-table.js') }}"></script>
<script src="{{ asset('adminassets/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminassets/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

@stack('custom-scripts')
</body>
</html>
