<nav class="sidebar">
    <div class="sidebar-header">
        <a href="
    {{ url('/admin') }}
    " class="sidebar-brand">
            BMB<span> Yönetim</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/admin') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Yönetim Paneli</span>
                </a>
            </li>
            <li class="nav-item nav-category">İşlemler</li>
            <li class="nav-item {{ active_class(['hakkimizda/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#hakkimizda" role="button"
                   aria-expanded="{{ is_active_route(['hakkimizda/*']) }}" aria-controls="hakkimizda">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Hakkımızda</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/hakkimizda/*']) }}" id="hakkimizda">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/admin/hakkimizda/duzenle') }}" class="nav-link">Hakkımızda</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['admin/laboratuvar/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#laboratuvar" role="button"
                   aria-expanded="{{ is_active_route(['admin/laboratuvar/*']) }}"
                   aria-controls="laboratuvar">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Laboratuvarlar</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/laboratuvar/*']) }}" id="laboratuvar">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/laboratuvar') }}" class="nav-link">Laboratuvarlar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/laboratuvar/create') }}" class="nav-link">Laboratuvarlar
                                Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Hedeflerimiz -->
            <li class="nav-item {{ active_class(['admin/hedefler/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#hedefler" role="button"
                   aria-expanded="{{ is_active_route(['admin/hedefler/*']) }}" aria-controls="hedefler">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Hedeflerimiz</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/hedefler/*']) }}" id="hedefler">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/hedefler') }}" class="nav-link">Hedeflerimiz</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/hedefler/create') }}" class="nav-link">Hedeflerimiz Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Ders İçerikleri -->
            <li class="nav-item {{ active_class(['admin/ders-icerikleri/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#ders-icerikleri" role="button"
                   aria-expanded="{{ is_active_route(['admin/ders-icerikleri/*']) }}" aria-controls="ders-icerikleri">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Ders İçerikleri</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/ders-icerikleri/*']) }}" id="ders-icerikleri">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/ders-icerikleri') }}" class="nav-link">Ders İçerikleri</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/ders-icerikleri/create') }}" class="nav-link">Ders İçerikleri
                                Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Akademik Personel -->
            <li class="nav-item {{ active_class(['admin/akademik-personel/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#akademik-personel" role="button"
                   aria-expanded="{{ is_active_route(['admin/akademik-personel/*']) }}"
                   aria-controls="akademik-personel">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Akademik Personel</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/akademik-personel/*']) }}" id="akademik-personel">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/akademik-personel') }}" class="nav-link">Akademik Personel</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/akademik-personel/ekle') }}" class="nav-link">Akademik Personel
                                Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Etkinlikler -->
            <li class="nav-item {{ active_class(['admin/etkinlik/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#etkinlik" role="button"
                   aria-expanded="{{ is_active_route(['admin/etkinlik/*']) }}" aria-controls="etkinlik">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Etkinlikler</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/etkinlik/*']) }}" id="etkinlik">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/etkinlik') }}" class="nav-link">Etkinlikler</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/etkinlik/create') }}" class="nav-link">Etkinlikler Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Haberler -->
            <li class="nav-item {{ active_class(['admin/haber/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#haber" role="button"
                   aria-expanded="{{ is_active_route(['admin/haber/*']) }}" aria-controls="haber">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Haberler</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/haber/*']) }}" id="haber">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/haber') }}" class="nav-link">Haberler</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/haber/create') }}" class="nav-link">Haberler Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Galeri -->
            <li class="nav-item {{ active_class(['admin/mufredat/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#mufredat" role="button"
                   aria-expanded="{{ is_active_route(['admin/mufredat/*']) }}" aria-controls="mufredat">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Müfredat</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/mufredat/*']) }}" id="mufredat">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/mufredat') }}" class="nav-link">Müfredat</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/mufredat/create') }}" class="nav-link">Müfredat Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- İletişim -->
            <li class="nav-item {{ active_class(['admin/iletisim/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#iletisim" role="button"
                   aria-expanded="{{ is_active_route(['admin/iletisim/*']) }}" aria-controls="iletisim">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">İletişim</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/iletisim/*']) }}" id="iletisim">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/iletisim') }}" class="nav-link">İletişim</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['admin/slider/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#slider" role="button"
                   aria-expanded="{{ is_active_route(['admin/slider/*']) }}" aria-controls="slider">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Slider</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin/slider/*']) }}" id="slider">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('admin/slider') }}" class="nav-link">Slider</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/slider/create') }}" class="nav-link">Slider Ekle</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['admin/sifre-degistir']) }}">
                <a href="{{route('sifre-degistir')}}" class="nav-link">
                    <i class="link-icon" data-feather="lock"></i>
                    <span class="link-title">Şifre Değiştir</span>
                </a>
            </li>

            <!--Çıkış -->
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="link-icon" data-feather="log-out"></i>
                    <span class="link-title">Çıkış</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>


        </ul>
    </div>
</nav>

