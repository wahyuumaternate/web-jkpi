<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <!-- Logo Group -->
        <div class="d-flex align-items-center gap-3">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('logo-jkpi.png') }}" alt="JKPI 2026">
            </a>

            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('logo_kota.png') }}" alt="Kota Ternate">
            </a>
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('logo_jkpi_2026.png') }}" alt="Kota Ternate">
            </a>
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('/assets/img/LogoKotaRempah.png') }}" alt="Kota Ternate">
            </a>
        </div>

        <!-- Navigation -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}#hero" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ url('/') }}#tentang">Tentang</a></li>
                <li><a href="{{ url('/') }}#tujuan">Tujuan</a></li>
                <li><a href="{{ url('/') }}#rangkaian">Rangkaian Kegiatan</a></li>
                {{-- <li><a href="{{ url('/') }}#buku-panduan">Buku Panduan</a></li> --}}


                <li class="dropdown"><a href="#"><span>Informasi Akomodasi</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ url('/hotel') }}">Daftar Hotel</a></li>
                        <li><a href="{{ url('/') }}#sebaran-lokasi">Sebaran Lokasi</a></li>
                        <li><a href="{{ url('/cafe-resto') }}">Daftar Resto & Cafe</a></li>
                        {{-- <li><a href="{{ url('/') }}#oleh-oleh">Toko Oleh-Oleh</a></li> --}}
                        <li><a href="{{ url('/') }}#buku-panduan">Buku Panduan</a></li>
                        <li><a href="{{ url('/') }}#appointment">Kontak</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('/') }}#galeri">Galeri</a></li>
                <li class="dropdown "><a href="#"><span>Pendaftaran</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ url('/registrasi') }}">Rakernas JKPI XII 2026</a></li>
                        <li><a href="#!">Nusantara Raya Run</a></li>
                        <li><a href="#!">Expo dan Pentas Budaya</a></li>

                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- CTA -->
        {{-- <a class="btn-getstarted d-none d-md-block" href="{{ url('/registrasi') }}">Registrasi</a> --}}

    </div>
</header>

<style>
    #header {
        background-color: #ffffff;
        transition: background-color 0.3s ease;
    }

    #header.header-scrolled {
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    #header .logo img {
        height: 200px !important;
    }

    @media (max-width: 768px) {
        #header .logo img {
            height: 45px !important;
        }
    }
</style>
