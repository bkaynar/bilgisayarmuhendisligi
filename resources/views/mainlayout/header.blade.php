<header>
    <div class="container">
        <div class="header-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="logo">
                <a href="{{ route('home') }}" title="">
                    <img src="{{ asset('mainassets/assets/img/logo.png') }}" alt=""
                         srcset="{{ asset('mainassets/assets/img/logo.png') }} 4x">
                </a>
            </div>
            <div class="logo2">
                <a href="{{ route('home') }}" title="">
                    <img src="{{ asset('mainassets/assets/img/logo_sonsuzluk_sade.png') }}" alt=""
                         srcset="{{ asset('mainassets/assets/img/logo_sonsuzluk_sade.png') }}">
                </a>
            </div>
            <div class="menu-btn">
                <a href="#">
                    <span class="bar1"></span>
                    <span class="bar2"></span>
                    <span class="bar3"></span>
                </a>
            </div>
        </div>
        <div class="navigation-bar d-flex flex-wrap align-items-center justify-content-center">
            <nav class="w-100">
                <ul class="d-flex justify-content-evenly">
                    <li><a href="{{ route('home') }}" title="">{{ __('messages.Home') }}</a></li>
                    <li><a href="{{ route('about') }}" title="">{{ __('messages.About Us') }}</a></li>
                    <li><a href="{{route('labs')}}" title="">{{ __('messages.Classes') }}</a></li>
                    <li><a href="{{route('academic-staff')}}" title="">{{ __('messages.Teachers') }}</a></li>
                    <li><a href="#" title="">{{ __('messages.Courses') }}</a><x-mufredat-component/>
                    <li><a href="{{route('news')}}" title="">{{ __('messages.News') }}</a></li>
                    <li><a href="{{ route('contact') }}" title="">{{ __('messages.Contact') }}</a></li>
                </ul>
            </nav>
            <div class="language-switcher ml-auto">
                <a href="{{ route('dil.degistir', ['locale' => 'tr']) }}"
                   class="{{ app()->getLocale() == 'tr' ? 'active' : '' }}">TR</a> |
                <a href="{{ route('dil.degistir', ['locale' => 'en']) }}"
                   class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            </div>
        </div>
    </div>
</header>
<div class="responsive-menu">
    <ul>
        <li><a href="{{ route('home') }}" title="">{{ __('messages.Home') }}</a></li>
        <li><a href="{{ route('about') }}" title="">{{ __('messages.About Us') }}</a></li>
        <li><a href="{{route('labs')}}" title="">{{ __('messages.Classes') }}</a></li>
        <li><a href="{{route('academic-staff')}}" title="">{{ __('messages.Teachers') }}</a></li>
        <li><a href="{{route('news')}}" title="">{{ __('messages.News') }}</a></li>
        <li><a href="{{ route('contact') }}" title="">{{ __('messages.Contact') }}</a></li>
        <div class="language-switcher ml-auto">
            <a href="{{ route('dil.degistir', ['locale' => 'tr']) }}"
               class="{{ app()->getLocale() == 'tr' ? 'active' : '' }}">TR</a> |
            <a href="{{ route('dil.degistir', ['locale' => 'en']) }}"
               class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
        </div>
    </ul>
</div><!--responsive-menu end-->

