<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>
        @if(Route::currentRouteName() == 'home')
            {{__('messages.Kırşehir Ahi Evran Üniversitesi')}} | {{__('messages.Bilgisayar Mühendisliği')}}
        @else
            @yield('title') | KAEU | {{__('messages.Bilgisayar Mühendisliği')}}
        @endif
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="KAEU | Bilgisayar Mühendisliği">
    <meta name="keywords" content=""/>
    <link rel="icon" href="{{'mainassets/assets/img/favicon.ico'}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mainassets/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mainassets/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('mainassets/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mainassets/assets/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mainassets/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
          integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<body>

<div class="wrapper">

    @include('mainlayout.header')

    @yield('content')

    @include('mainlayout.footer')

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.querySelector('.menu-btn a');
        const responsiveMenu = document.querySelector('.responsive-menu');

        menuBtn.addEventListener('click', function(event) {
            event.preventDefault();
            responsiveMenu.classList.toggle('active');
        });
    });
</script>
<script src="../../../public/mainassets/assets/js/jquery.js"></script>
<script src="../../../public/mainassets/assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script><script src="{{asset('public/mainassets/assets/js/isotope.js')}}"></script>
<script src="{{asset('public/mainassets/assets/js/html5lightbox.js')}}"></script>
<script src="{{asset('public/mainassets/assets/js/slick.min.js')}}"></script>
<script src="{{asset('public/mainassets/assets/js/tweenMax.js')}}"></script>
<script src="{{asset('public/mainassets/assets/js/wow.min.js')}}"></script>
<script src="{{asset('public/mainassets/assets/js/scripts.js')}}"></script>


</body>

</html>
