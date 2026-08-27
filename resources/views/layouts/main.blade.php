<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Rakernas XII JKPI 2026 - Ternate')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="@yield('meta_description', 'Website Resmi Rakernas XII JKPI 2026 di Ternate. Rapat Kerja Nasional Jaringan Kota Pusaka Indonesia membahas pelestarian warisan budaya dengan tema Pusaka Ternate, Pusaka Dunia. Daftar sekarang!')">

    <meta name="keywords" content="@yield('meta_keywords', 'JKPI 2026, Rakernas JKPI, Rakernas XII JKPI, Jaringan Kota Pusaka Indonesia, Kota Ternate, Warisan Budaya, Pelestarian Pusaka, Pusaka Indonesia, Konservasi Budaya, Heritage Indonesia, Maluku Utara, Ternate 2026, Event JKPI, Kongres Pusaka')">

    <meta name="author" content="JKPI - Jaringan Kota Pusaka Indonesia">
    <meta name="robots" content="@yield('meta_robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <meta name="googlebot" content="index, follow">

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Open Graph / Facebook Meta Tags --}}
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Rakernas XII JKPI 2026">
    <meta property="og:title" content="@yield('og_title', 'Rakernas XII JKPI 2026 - Pusaka Ternate, Pusaka Dunia')">
    <meta property="og:description" content="@yield('og_description', 'Rapat Kerja Nasional ke-12 Jaringan Kota Pusaka Indonesia di Ternate. Bergabunglah dalam diskusi pelestarian warisan budaya dan pusaka Indonesia. Pusaka Ternate, Pusaka Dunia.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('opening.jpg'))">
    <meta property="og:image:secure_url" content="@yield('og_image', asset('opening.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="@yield('og_image_alt', 'Rakernas XII JKPI 2026 Ternate - Pusaka Ternate Pusaka Dunia')">
    <meta property="og:image:type" content="image/jpeg">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Rakernas XII JKPI 2026 - Pusaka Ternate, Pusaka Dunia')">
    <meta name="twitter:description" content="@yield('og_description', 'Rapat Kerja Nasional ke-12 Jaringan Kota Pusaka Indonesia di Ternate. Diskusi pelestarian warisan budaya dan pusaka Indonesia.')">
    <meta name="twitter:image" content="@yield('og_image', asset('opening.jpg'))">
    <meta name="twitter:image:alt" content="@yield('og_image_alt', 'Rakernas XII JKPI 2026 Ternate')">
    <meta name="twitter:site" content="@jkpi_indonesia">
    <meta name="twitter:creator" content="@jkpi_indonesia">

    {{-- Additional Meta Tags --}}
    <meta name="theme-color" content="#1a56db">
    <meta name="format-detection" content="telephone=no">

    {{-- Geo Meta Tags --}}
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7893;127.3614">
    <meta name="ICBM" content="0.7893, 127.3614">

    {{-- Schema.org JSON-LD — diisi per halaman lewat @push('schema') --}}
    @stack('schema')

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicomatic/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{ asset('favicomatic/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="{{ asset('favicomatic/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('favicomatic/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="{{ asset('favicomatic/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('favicomatic/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ asset('favicomatic/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('favicomatic/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ asset('favicomatic/apple-touch-icon-152x152.png') }}">

    <!-- Favicons PNG -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicomatic/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicomatic/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicomatic/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicomatic/favicon-128.png') }}">
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('favicomatic/favicon-196x196.png') }}">

    <!-- Microsoft Tiles -->
    <meta name="application-name" content="&nbsp;">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="{{ asset('favicomatic/mstile-144x144.png') }}">
    <meta name="msapplication-square70x70logo" content="{{ asset('favicomatic/mstile-70x70.png') }}">
    <meta name="msapplication-square150x150logo" content="{{ asset('favicomatic/mstile-150x150.png') }}">
    <meta name="msapplication-wide310x150logo" content="{{ asset('favicomatic/mstile-310x150.png') }}">
    <meta name="msapplication-square310x310logo" content="{{ asset('favicomatic/mstile-310x310.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">
    @stack('styles')
</head>

<body class="@yield('body-class', 'index-page')">

    @include('partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
