<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Rakernas XII JKPI 2026 - Ternate')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description"
        content="Website Resmi Rakernas XII JKPI 2026 di Ternate. Rapat Kerja Nasional Jaringan Kota Pusaka Indonesia membahas pelestarian warisan budaya dengan tema Pusaka Ternate, Pusaka Dunia. Daftar sekarang!">

    <meta name="keywords"
        content="JKPI 2026, Rakernas JKPI, Rakernas XII JKPI, Jaringan Kota Pusaka Indonesia, Kota Ternate, Warisan Budaya, Pelestarian Pusaka, Pusaka Indonesia, Konservasi Budaya, Heritage Indonesia, Maluku Utara, Ternate 2026, Event JKPI, Kongres Pusaka">

    <meta name="author" content="JKPI - Jaringan Kota Pusaka Indonesia">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook Meta Tags --}}
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Rakernas XII JKPI 2026">
    <meta property="og:title" content="Rakernas XII JKPI 2026 - Pusaka Ternate, Pusaka Dunia">
    <meta property="og:description"
        content="Rapat Kerja Nasional ke-12 Jaringan Kota Pusaka Indonesia di Ternate. Bergabunglah dalam diskusi pelestarian warisan budaya dan pusaka Indonesia. Pusaka Ternate, Pusaka Dunia.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/img/JKPI-2025/4.JPG') }}">
    <meta property="og:image:secure_url" content="{{ asset('assets/img/JKPI-2025/4.JPG') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Rakernas XII JKPI 2026 Ternate - Pusaka Ternate Pusaka Dunia">
    <meta property="og:image:type" content="image/jpeg">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Rakernas XII JKPI 2026 - Pusaka Ternate, Pusaka Dunia">
    <meta name="twitter:description"
        content="Rapat Kerja Nasional ke-12 Jaringan Kota Pusaka Indonesia di Ternate. Diskusi pelestarian warisan budaya dan pusaka Indonesia.">
    <meta name="twitter:image" content="{{ asset('assets/img/JKPI-2025/4.JPG') }}">
    <meta name="twitter:image:alt" content="Rakernas XII JKPI 2026 Ternate">
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

    {{-- Schema.org Structured Data (JSON-LD) --}}
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "Rakernas XII JKPI 2026",
  "description": "Rapat Kerja Nasional ke-12 Jaringan Kota Pusaka Indonesia dengan tema Pusaka Ternate, Pusaka Dunia",
  "image": "{{ asset('assets/img/JKPI-2025/4.JPG') }}",
  "startDate": "2026-03-15",
  "endDate": "2026-03-18",
  "eventStatus": "https://schema.org/EventScheduled",
  "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
  "location": {
    "@type": "Place",
    "name": "Kota Ternate",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Ternate",
      "addressLocality": "Ternate",
      "addressRegion": "Maluku Utara",
      "postalCode": "97700",
      "addressCountry": "ID"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "0.7893",
      "longitude": "127.3614"
    }
  },
  "organizer": {
    "@type": "Organization",
    "name": "Jaringan Kota Pusaka Indonesia (JKPI)",
    "url": "{{ url('/') }}"
  },
  "performer": {
    "@type": "Organization",
    "name": "JKPI"
  }
}
</script>

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Jaringan Kota Pusaka Indonesia (JKPI)",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('assets/img/JKPI-2025/4.JPG') }}",
  "description": "Jaringan Kota Pusaka Indonesia adalah organisasi yang fokus pada pelestarian dan pengembangan kota-kota pusaka di Indonesia",
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "Customer Service",
    "availableLanguage": ["Indonesian", "English"]
  },
  "sameAs": [
    "https://www.facebook.com/jkpi.indonesia",
    "https://twitter.com/jkpi_indonesia",
    "https://www.instagram.com/jkpi.indonesia"
  ]
}
</script>

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Rakernas XII JKPI 2026",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/') }}/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Favicons -->
    <link href="{{ asset('logo_kota.png') }}" rel="icon">
    <link href="{{ asset('logo_kota.png') }}" rel="apple-touch-icon">

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
