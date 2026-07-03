<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Basic Meta Tags --}}
    <title>Rakernas XII JKPI 2026 - Pusaka Ternate, Pusaka Dunia | Jaringan Kota Pusaka Indonesia</title>

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
    <meta name="theme-color" content="#099aa7">
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
  "startDate": "2026-08-26",
  "endDate": "2026-08-30",
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

    <style>
        .section-title-map {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title-map h2 {
            font-size: 2.8rem;
            font-weight: 800;
            color: #099aa7;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title-map h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #099aa7, #077b86);
            border-radius: 2px;
        }

        .section-title-map p {
            font-size: 1.1rem;
            color: #666;
            max-width: 800px;
            margin: 20px auto 0;
        }

        #map-jkpi {
            height: 700px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border: 3px solid #099aa7;
        }

        .map-container-jkpi {
            position: relative;
            margin-bottom: 40px;
            z-index: 1;
        }

        .location-legend-jkpi {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .legend-title-jkpi {
            font-size: 1.3rem;
            font-weight: 700;
            color: #099aa7;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-item-jkpi {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .legend-item-jkpi:hover {
            background: #f0f9fa;
            transform: translateX(5px);
        }

        .legend-icon-jkpi {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            color: white;
        }

        .legend-text-jkpi h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .legend-text-jkpi p {
            margin: 0;
            font-size: 0.85rem;
            color: #777;
        }

        .venue-main {
            background: #099aa7;
        }

        .heritage-site {
            background: #099aa7;
        }

        .market-area {
            background: #099aa7;
        }

        .workshop-room {
            background: #099aa7;
        }

        .stage-culture {
            background: #099aa7;
        }

        .map-controls-jkpi {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .control-btn-jkpi {
            display: block;
            width: 100%;
            padding: 8px 15px;
            margin-bottom: 8px;
            border: none;
            background: #099aa7;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .control-btn-jkpi:hover {
            background: #077b86;
            transform: translateY(-2px);
        }

        .stats-overview-jkpi {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card-jkpi {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .stat-card-jkpi:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card-jkpi i {
            font-size: 2.5rem;
            color: #099aa7;
            margin-bottom: 15px;
        }

        .stat-number-jkpi {
            font-size: 2rem;
            font-weight: 800;
            color: #099aa7;
            margin-bottom: 5px;
        }

        .stat-label-jkpi {
            font-size: 0.95rem;
            color: #666;
            font-weight: 500;
        }

        .custom-marker-icon {
            background: white;
            border: 3px solid #099aa7;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        }

        .popup-content-jkpi {
            padding: 0;
            min-width: 280px;
        }

        .popup-image-jkpi {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
            margin-bottom: 12px;
        }

        .popup-body-jkpi {
            padding: 0 12px 12px 12px;
        }

        .popup-content-jkpi h4 {
            margin: 0 0 8px 0;
            color: #099aa7;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .popup-content-jkpi p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #555;
            line-height: 1.4;
        }

        .popup-content-jkpi .distance-info {
            display: flex;
            gap: 15px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .distance-info span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            color: #099aa7;
            font-weight: 600;
        }

        .leaflet-popup-content-wrapper {
            padding: 0;
            border-radius: 12px;
            overflow: hidden;
        }

        .leaflet-popup-content {
            margin: 0;
            width: auto !important;
        }

        @media (max-width: 768px) {
            #map-jkpi {
                height: 500px;
            }

            .section-title-map h2 {
                font-size: 2rem;
            }

            .map-controls-jkpi {
                top: 10px;
                right: 10px;
                padding: 10px;
            }
        }

        @keyframes slide {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 100px 100px;
            }
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        #hero a:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(255, 255, 255, 0.6) !important;
        }

        @media (max-width: 768px) {
            #hero h1 {
                font-size: 2.5rem !important;
            }

            #hero h1 span {
                font-size: 3rem !important;
            }

            #hero p {
                font-size: 1.1rem !important;
            }
        }

        .image-hover-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .image-hover-wrapper img {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            display: block;
            width: 100%;
        }

        .image-hover-wrapper:hover img {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .image-hover-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            transition: background 0.5s ease;
            z-index: 1;
            pointer-events: none;
        }

        .image-hover-wrapper:hover::before {
            background: rgba(0, 0, 0, 0.1);
        }

        .service-card {
            background: linear-gradient(135deg, #099aa715, #099aa715) !important;
            color: #ffffff !important;
        }
    </style>
</head>


<body class="index-page">

    @include('partials.header')

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section"
            style="background: linear-gradient(135deg, rgba(9, 154, 167, 0.302) 0%, rgba(7, 123, 134, 0.92) 100%), url('{{ asset('culture3.jpg') }}') center/cover no-repeat; min-height: 100vh; position: relative; overflow: hidden; background-blend-mode: multiply;">

            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('{{ asset('culture3.jpg') }}') center/cover no-repeat; opacity: 0.12; mix-blend-mode: overlay; filter: contrast(1.05) brightness(1.0);">
            </div>
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.02) 35px, rgba(255,255,255,.02) 70px); animation: slide 20s linear infinite;">
            </div>
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(ellipse at center, transparent 20%, rgba(0,0,0,0.2) 100%);">
            </div>

            <div class="container" style="position: relative; z-index: 2;">
                <div class="row align-items-center" style="min-height: 90vh;">
                    <div class="col-lg-12 text-center">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="badge-container mb-4 mt-5" data-aos="zoom-in" data-aos-delay="300">
                                <span
                                    style="background: rgba(255, 255, 255, 0.30); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); color: #fff; padding: 12px 30px; border-radius: 50px; font-weight: 600; font-size: 0.95rem; letter-spacing: 1px; border: 2px solid rgba(255,255,255,0.5); box-shadow: 0 8px 32px rgba(0,0,0,0.3); display: inline-block;">
                                    <i class="bi bi-geo-alt-fill me-2"></i>RAKERNAS JARINGAN KOTA PUSAKA INDONESIA XII
                                </span>
                            </div>
                            <h1 data-aos="fade-up" data-aos-delay="400"
                                style="color: #fff; font-size: 4.5rem; font-weight: 900; text-shadow: 3px 3px 20px rgba(0,0,0,0.5), 1px 1px 8px rgba(0,0,0,0.7); margin-bottom: 30px; line-height: 1.2; letter-spacing: -1px;">
                                PUSAKA TERNATE<br>
                                <span
                                    style="color: #FFFFFF; font-size: 5rem; text-shadow: 3px 3px 20px rgba(0,0,0,0.5), 1px 1px 8px rgba(0,0,0,0.7), 0 0 20px rgba(255,255,255,0.3);">PUSAKA
                                    DUNIA</span>
                            </h1>
                            <p data-aos="fade-up" data-aos-delay="500"
                                style="color: rgba(255,255,255,0.98); font-size: 1.4rem; max-width: 900px; margin: 0 auto 50px; line-height: 1.8; text-shadow: 2px 2px 12px rgba(0,0,0,0.5), 1px 1px 4px rgba(0,0,0,0.7); font-weight: 400;">
                                Kota Ternate Dengan Bangga Menjadi Tuan Rumah Rakernas JKPI Ke-XII Tahun 2026<br>
                                <strong style="font-weight: 700;">TERNATE: EPISENTRUM REMPAH DUNIA</strong>
                            </p>
                            <div data-aos="fade-up" data-aos-delay="700" style="margin-bottom: 40px;">
                                <a href="{{ url('/registrasi') }}"
                                    style="background: linear-gradient(135deg, #FFFFFF 0%, #E0E0E0 100%); color: #099aa7; padding: 18px 50px; border-radius: 50px; font-weight: 700; font-size: 1.2rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 12px 45px rgba(255, 255, 255, 0.4), 0 5px 15px rgba(0,0,0,0.3); transition: all 0.3s; border: none;">
                                    <i class="bi bi-pencil-square me-2"></i>DAFTAR RAKERNAS JKPI XII 2026
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- Tentang JKPI Section -->
        <section id="tentang" class="home-about section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="section-title col-lg-8 mx-auto text-center" data-aos="fade-up" data-aos-delay="150">
                        <h2 class="section-heading">Tentang JKPI</h2>
                    </div>
                </div>
                <div class="row align-items-center mb-5 pb-2">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <p class="lead-description mb-4">
                            Jaringan Kota Pusaka Indonesia (JKPI) adalah organisasi jejaring nasional yang menghimpun
                            kabupaten dan kota di Indonesia yang berkomitmen terhadap pelestarian pusaka, baik berwujud
                            <em>(tangible heritage)</em> maupun tidak berwujud <em>(intangible heritage)</em>, sebagai
                            bagian dari
                            pembangunan daerah yang berkelanjutan. JKPI didirikan pada 25 Oktober 2008 di Surakarta,
                            bertepatan dengan penyelenggaraan Konferensi dan Pameran Organisasi Kota Pusaka Eropa–Asia
                            (OWHC Euro-Asia) Tahun
                            2008, yang melahirkan Deklarasi Surakarta sebagai tonggak awal pembentukannya. Sejak
                            berdiri, JKPI
                            berperan sebagai organisasi induk dan wadah kolaborasi antar pemerintah daerah dalam
                            pengelolaan dan pelestarian pusaka alam dan budaya. Hingga tahun 2025, JKPI telah
                            beranggotakan 79 kabupaten/kota dari seluruh Indonesia, mencerminkan semakin kuatnya
                            komitmen daerah dalam menjaga warisan pusaka sebagai identitas, sumber nilai, dan penggerak
                            pembangunan berkelanjutan.
                        </p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="250">
                        <div class="image-hover-wrapper">
                            <img src="{{ asset('assets/img/JKPI-2025/4.JPG') }}" alt="Tentang JKPI"
                                class="img-fluid rounded shadow">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Tentang JKPI Section -->

        <!-- Tujuan Penyelenggaraan Section -->
        <section id="tujuan" class="featured-services section light-background">
            <div class="container section-title" data-aos="fade-up">
                <h2>Tujuan Penyelenggaraan JKPI</h2>
                <p>Rakernas JKPI XII 2026 diselenggarakan dengan berbagai tujuan strategis untuk kemajuan pelestarian
                    pusaka Indonesia</p>
            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="service-content">
                                <h3>Memperkuat Kolaborasi</h3>
                                <p>Membangun sinergi antar kota pusaka dalam melestarikan situs sejarah, merevitalisasi
                                    kawasan heritage, dan mengembangkan kota berbasis warisan budaya untuk pembangunan
                                    berkelanjutan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card">
                            <div class="service-content">
                                <h3>Berbagi Pengalaman</h3>
                                <p>Forum diskusi nasional yang mempertemukan kepala daerah dan pemangku kepentingan
                                    untuk berbagi best practices dalam pengelolaan kota pusaka dan pelestarian warisan
                                    budaya.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-card">
                            <div class="service-content">
                                <h3>Mengembangkan Ekonomi Kreatif</h3>
                                <p>Mendorong pertumbuhan UMKM dan ekonomi kreatif lokal melalui promosi produk unggulan
                                    berbasis budaya dan pengembangan pasar berkelanjutan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="service-content">
                                <h3>Edukasi dan Pelatihan</h3>
                                <p>Menyelenggarakan seminar dan workshop tentang konservasi pusaka, arsitektur heritage,
                                    dan pemberdayaan masyarakat dalam pelestarian budaya.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card">
                            <div class="service-content">
                                <h3>Kerjasama Internasional</h3>
                                <p>Membangun jaringan kerjasama dengan organisasi internasional dan negara lain dalam
                                    pelestarian warisan budaya dan pertukaran knowledge.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-card">
                            <div class="service-content">
                                <h3>Pariwisata Berkelanjutan</h3>
                                <p>Mengembangkan destinasi wisata pusaka yang memberikan dampak ekonomi positif bagi
                                    masyarakat lokal dengan tetap menjaga kelestarian budaya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Tujuan Section -->

        <!-- Jaringan Kota Pusaka Section -->
        <section id="jaringan" class="home-about section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-10 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="150">
                        <h2 class="section-heading">Jaringan Kota Pusaka Indonesia</h2>
                        <p class="lead-description">JKPI menghubungkan 79 kabupaten dan kota di seluruh Indonesia yang
                            memiliki komitmen kuat dalam pelestarian warisan budaya dan pengembangan kota berbasis
                            pusaka.</p>
                    </div>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item text-center">
                            <div class="stat-number"
                                style="font-size: 3rem; font-weight: 800; color: #099aa7; margin-bottom: 10px;">
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="79"
                                    data-purecounter-duration="1">79</span>
                            </div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #666;">Kab/Kota Anggota JKPI
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item text-center">
                            <div class="stat-number"
                                style="font-size: 3rem; font-weight: 800; color: #099aa7; margin-bottom: 10px;">
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="38"
                                    data-purecounter-duration="1">38</span>
                            </div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #666;">Provinsi</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-item text-center">
                            <div class="stat-number"
                                style="font-size: 3rem; font-weight: 800; color: #099aa7; margin-bottom: 10px;">
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="1000"
                                    data-purecounter-duration="1">1000</span>+
                            </div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #666;">Peserta Rakernas</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="stat-item text-center">
                            <div class="stat-number"
                                style="font-size: 3rem; font-weight: 800; color: #099aa7; margin-bottom: 10px;">
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="17"
                                    data-purecounter-duration="1">17</span>+
                            </div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #666;">Tahun Berdiri</div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Jaringan Kota Pusaka Section -->

        <!-- Rangkaian Kegiatan Section -->
        <section id="rangkaian" class="featured-departments section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Rangkaian Kegiatan JKPI 2026</h2>
                <p>26 – 30 Agustus 2026 &bull; Kota Ternate, Maluku Utara</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="departments-showcase">

                    <div class="featured-department" data-aos="fade-up" data-aos-delay="200">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-1">
                                <div class="department-content">
                                    <div class="department-category">Program Istimewa</div>
                                    <h2 class="department-title">Simposium Pulau-Pulau Penghasil Rempah</h2>
                                    <p class="department-description">Untuk pertama kalinya, Ternate akan menjadi tuan
                                        rumah Simposium Pulau-Pulau Penghasil Rempah berskala internasional. Momentum
                                        strategis memperkenalkan kualitas cengkeh dan rempah Ternate yang tak
                                        tertandingi.</p>
                                    <div class="department-features">
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Diskusi Internasional Rempah Nusantara</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Pameran Produk Rempah Berkualitas</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Kerjasama Ekonomi Berbasis Rempah</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-2">
                                <div class="department-visual">
                                    <div class="image-wrapper">
                                        <img src="{{ asset('assets/img/JKPI-2025/12.JPG') }}" alt="Simposium Rempah"
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =============================================
                 TAB NAVIGATION — sesuai PDF PIC resmi
                 Tanggal resmi: 25 - 30 Agustus 2026
            ============================================== -->
                    <div class="event-tabs-container" data-aos="fade-up" data-aos-delay="300">
                        <div class="d-flex justify-content-center">
                            <ul class="nav nav-pills event-tabs mb-5" id="eventTabs" role="tablist">

                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pre-event-tab" data-bs-toggle="pill"
                                        data-bs-target="#pre-event" type="button" role="tab"
                                        aria-controls="pre-event" aria-selected="true">
                                        Pre Event
                                    </button>
                                </li> --}}

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="hari1-tab" data-bs-toggle="pill"
                                        data-bs-target="#hari1" type="button" role="tab" aria-controls="hari1"
                                        aria-selected="false">
                                        26 Agustus
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="hari2-tab" data-bs-toggle="pill"
                                        data-bs-target="#hari2" type="button" role="tab" aria-controls="hari2"
                                        aria-selected="false">
                                        27 Agustus
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="hari3-tab" data-bs-toggle="pill"
                                        data-bs-target="#hari3" type="button" role="tab" aria-controls="hari3"
                                        aria-selected="false">
                                        28 Agustus
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="hari4-tab" data-bs-toggle="pill"
                                        data-bs-target="#hari4" type="button" role="tab" aria-controls="hari4"
                                        aria-selected="false">
                                        29 Agustus
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="hari5-tab" data-bs-toggle="pill"
                                        data-bs-target="#hari5" type="button" role="tab" aria-controls="hari5"
                                        aria-selected="false">
                                        30 Agustus
                                    </button>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-content" id="eventTabsContent">

                            <!-- ══ Pre Event: 25 Agustus ══ -->
                            {{-- <div class="tab-pane fade show active" id="pre-event" role="tabpanel"
                                aria-labelledby="pre-event-tab">
                                <div class="event-list">

                                    <div class="event-item">
                                        <h4 class="event-name">Welcome Dinner</h4>
                                        <p class="event-datetime">Selasa, 25 Agustus 2026 &bull; 19.15 – 22.00 WIT</p>
                                        <p class="event-description">Jamuan Makan Malam Kebudayaan sebagai pembuka
                                            rangkaian Rakernas JKPI ke-XII Ternate 2026.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Pendopo Kediaman Wali Kota Ternate
                                        </p>
                                    </div>

                                </div>
                            </div> --}}

                            <!-- ══ 26 Agustus (Rabu): Master Class, Ladies Program, Expo & Pentas Budaya (hari 1) ══ -->
                            <div class="tab-pane fade show active" id="hari1" role="tabpanel"
                                aria-labelledby="hari1-tab">
                                <div class="event-list">

                                    <div class="event-item">
                                        <h4 class="event-name">Master Class</h4>
                                        <p class="event-datetime">Rabu, 26 Agustus 2026 &bull; 07.30 – 15.30 WIT</p>
                                        <p class="event-description">
                                            <strong>Economic Culture &amp; Pengelolaan Museum</strong> – Benteng
                                            Oranje<br>
                                            <strong>Living Museum</strong> – Benteng Kastela<br>
                                            <strong>Gastronomi Rempah</strong> – Kel. Tongole<br>
                                            <strong>Pengolahan Bambu</strong> – Buku Bendera<br>
                                            <strong>Residensi Grafis</strong> – Benteng Tolukko
                                        </p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Berbagai Titik Cagar Budaya Ternate
                                        </p>

                                    </div>

                                    <div class="event-item">
                                        <h4 class="event-name"> Opening Ceremony <br> Pasar Malam Indonesia, Pentas
                                            Budaya
                                            &amp; Festival Gastronomi <span class="badge-hari">Hari
                                                ke-1</span></h4>
                                        <p class="event-datetime">Rabu, 26 Agustus 2026 &bull; 16.30 – 23.00 WIT</p>
                                        <p class="event-description">
                                            Pembukaan Pasar Malam Indonesia · Pameran "Surat-Surat Dari Ternate" ·
                                            Pertunjukan Seni Budaya
                                            Delegasi
                                            JKPI · Menampilkan Keragaman Budaya, Kuliner, dan Kreativitas dari Seluruh
                                            Peserta
                                            JKPI.
                                        </p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                        </p>
                                    </div>

                                    <div class="event-item">
                                        <h4 class="event-name">Makan Bersama</h4>
                                        <p class="event-datetime">Rabu, 26 Agustus 2026 &bull; 19.15 – 22.00 WIT</p>
                                        <p class="event-description">Jamuan Makan Kebudayaan Sebagai Pembuka
                                            Rangkaian Rakernas JKPI ke-XII Ternate 2026.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Pendopo Kediaman Wali Kota Ternate
                                        </p>
                                    </div>






                                </div>
                            </div>

                            <!-- ══ 27 Agustus (Kamis): Simposium Internasional, Expo & Pentas (hari 2) ══ -->
                            <div class="tab-pane fade" id="hari2" role="tabpanel" aria-labelledby="hari2-tab">
                                <div class="event-list">
                                    <div class="event-item">
                                        <h4 class="event-name">Ladies Program</h4>
                                        <p class="event-datetime">Rabu, 27 Agustus 2026 &bull; 07.00 – 10.30 WIT</p>
                                        <p class="event-description">Yoga Bersama, Demo Masak dan Pengenalan Tenun
                                            Ternate.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                        </p>
                                    </div>
                                    <div class="event-item">
                                        <h4 class="event-name">Simposium Internasional</h4>
                                        <p class="event-datetime">Kamis, 27 Agustus 2026 &bull; 08.00 – 16.00 WIT</p>
                                        <p class="event-description">Tema: <em>"Pulau-Pulau Penghasil Rempah"</em> —
                                            Forum Internasional yang Mempertemukan Akademisi, Pelaku Industri, dan
                                            Pemangku
                                            Kepentingan Rempah Dari Berbagai Negara.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Bela Hotel
                                        </p>
                                    </div>

                                    <div class="event-item">
                                        <h4 class="event-name">Pasar Malam Indonesia, Pentas Budaya &amp; Festival
                                            Gastronomi <span class="badge-hari">Hari
                                                ke-2</span></h4>
                                        <p class="event-datetime">Kamis, 27 Agustus 2026 &bull; 15.00 – 23.00 WIT</p>
                                        <p class="event-description">Pertunjukan Seni Budaya Delegasi JKPI dan Pameran
                                            Booth Kota — Menampilkan Keragaman Budaya, Kuliner, dan Kreativitas dari
                                            Seluruh
                                            Peserta JKPI.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <!-- ══ 28 Agustus (Jumat): Rakernas, Festival Gastronomi, Gelar Budaya & Penyerahan Pataka, Expo (hari 3) ══ -->
                            <div class="tab-pane fade" id="hari3" role="tabpanel" aria-labelledby="hari3-tab">
                                <div class="event-list">

                                    <div class="event-item">
                                        <h4 class="event-name">Rapat Kerja Nasional</h4>
                                        <p class="event-datetime">Jumat, 28 Agustus 2026 &bull; 08.00 – 12.00 WIT</p>
                                        <p class="event-description">Penyusunan Kebijakan dan Memperkuat Kolaborasi
                                            dalam Pelestarian Kota Pusaka Secara Berkelanjutan.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Bela Hotel
                                        </p>
                                    </div>
                                    <div class="event-item">
                                        <h4 class="event-name">Seminar Nasional</h4>
                                        <p class="event-datetime">Sabtu, 28 Agustus 2026 &bull; 13.30 – 16.00 WIT</p>
                                        <p class="event-description">Tema: <em>"City Gallery sebagai Ruang Inklusif
                                                untuk
                                                Memperkuat Identitas Kota Pusaka"</em> - Forum Kolaborasi Nasional
                                            Hexahelix Memori Kolektif dan Kota Pusaka.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Aula Banau Kampus 1 Universitas Khairun
                                        </p>
                                    </div>
                                    <div class="event-item">
                                        <h4 class="event-name">Festival Gastronomi</h4>
                                        <p class="event-datetime">Jumat, 28 Agustus 2026 &bull; 15.00 – 18.00 WIT</p>
                                        <p class="event-description">Cerminan Identitas Budaya Lokal dan Sarana
                                            Pelestarian Tradisi — Kurasi Tenant Makanan Berbasis Rempah Dengan Narasi
                                            Budaya.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                        </p>
                                    </div>

                                    <div class="event-item">
                                        <h4 class="event-name">Pasar Malam Indonesia, Pentas Budaya &amp; Festival
                                            Gastronomi <span class="badge-hari">Hari
                                                ke-3</span></h4>
                                        <p class="event-datetime">Jumat, 28 Agustus 2026 &bull; 15.00 – 23.00 WIT</p>
                                        <p class="event-description">Pertunjukan Seni Budaya Delegasi JKPI dan Pameran
                                            Booth Kota — Menampilkan Keragaman Budaya, Kuliner, dan Kreativitas dari
                                            Seluruh
                                            Peserta JKPI.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                        </p>
                                    </div>

                                    <div class="event-item">
                                        <h4 class="event-name">Gelar Budaya &amp; Penyerahan Pataka</h4>
                                        <p class="event-datetime">Jumat, 28 Agustus 2026 &bull; 19.00 – 21.55 WIT</p>
                                        <p class="event-description">Ramah Tamah, Pagelaran Budaya, dan Penyerahan
                                            Tanggung Jawab Penyelenggaraan Tuan Rumah Rakernas JKPI ke-XIII ke Kota
                                            Bandung.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Landmark Ternate
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <!-- ══ 29 Agustus (Sabtu): Pawai Budaya & Karnaval, Expo (hari 4 / penutup) ══ -->
                            <div class="tab-pane fade" id="hari4" role="tabpanel" aria-labelledby="hari4-tab">
                                <div class="event-list">
                                    <div class="event-item">
                                        <h4 class="event-name">Heritage City Tour</h4>
                                        <p class="event-datetime">Sabtu, 29 Agustus 2026 &bull; 08.30 – 13.40 WIT</p>
                                        <p class="event-description">Kunjungan Kepala Daerah Peserta JKPI ke Kawasan
                                            Cagar Budaya dan Kadaton Kesultanan Ternate.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Kadaton Kesultanan Ternate &amp; Kawasan
                                            Cagar Budaya
                                        </p>
                                    </div>
                                    <div class="event-item">
                                        <h4 class="event-name">Pasar Malam Indonesia, Pentas Budaya &amp; Festival
                                            Gastronomi <span class="badge-hari">Hari
                                                ke-4</span></h4>
                                        <p class="event-datetime">Sabtu, 29 Agustus 2026 &bull; 14.00 – 18.00 WIT</p>
                                        <p class="event-description">Hari keempat Expo dan Pentas Budaya — Pertunjukan
                                            Seni Budaya Delegasi JKPI dan Pameran Booth Kota.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                        </p>
                                    </div>

                                    <div class="event-item">
                                        <h4 class="event-name">Pawai Budaya dan Karnaval</h4>
                                        <p class="event-datetime">Sabtu, 29 Agustus 2026 &bull; 19.30 – 23.00 WIT</p>
                                        <p class="event-description">Pawai Budaya Delegasi JKPI — Menampilkan Karya
                                            Budaya Khas Daerah Dalam Defile Sepanjang Rute Benteng Oranje Menuju
                                            Lapangan
                                            Ngaralamo Salero.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Benteng Oranje – Lapangan Ngaralamo
                                            Salero
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <!-- ══ 30 Agustus (Minggu): Nusantara Raya Run ══ -->
                            <div class="tab-pane fade" id="hari5" role="tabpanel" aria-labelledby="hari5-tab">
                                <div class="event-list">

                                    <div class="event-item">
                                        <h4 class="event-name">Nusantara Raya Run</h4>
                                        <p class="event-datetime">Minggu, 30 Agustus 2026 &bull; 05.30 – 09.00 WIT</p>
                                        <p class="event-description">Ajang Lari Nasional Fort to Fort yang Memadukan
                                            Olahraga, Semangat Persatuan, dan Promosi Potensi Budaya serta Pariwisata
                                            Daerah.</p>
                                        <p class="event-location">
                                            <i class="bi bi-geo-alt-fill"></i> Fort to Fort — Benteng Kalamata ke
                                            Benteng
                                            Oranje
                                        </p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /Tab Navigation -->

                </div>
            </div>
        </section><!-- /Rangkaian Kegiatan Section -->

        <style>
            /* Event Tabs Styling */
            .event-tabs-container {
                margin-top: 60px;
            }

            .event-tabs {
                border: none;
                background: #fff;
                padding: 10px;
                border-radius: 50px;
                box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
                display: inline-flex;
                gap: 5px;
            }

            .event-tabs .nav-item {
                margin: 0;
            }

            .event-tabs .nav-link {
                border: none;
                background: transparent;
                color: #666;
                padding: 12px 28px;
                font-weight: 600;
                font-size: 0.95rem;
                border-radius: 40px;
                transition: all 0.3s ease;
                white-space: nowrap;
            }

            .event-tabs .nav-link:hover {
                color: #099aa7;
                background: rgba(9, 154, 167, 0.08);
            }

            .event-tabs .nav-link.active {
                background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
                color: #fff;
                box-shadow: 0 5px 15px rgba(9, 154, 167, 0.3);
            }

            /* Event List Styling */
            .event-list {
                max-width: 900px;
                margin: 0 auto;
                padding: 20px;
            }

            .event-item {
                background: #fff;
                border-radius: 12px;
                padding: 30px;
                margin-bottom: 20px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
                border-left: 4px solid #099aa7;
                transition: all 0.3s ease;
            }

            .event-item:hover {
                transform: translateX(5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            }

            .event-name {
                font-size: 1.4rem;
                font-weight: 700;
                color: #099aa7;
                margin-bottom: 12px;
            }

            .event-datetime {
                font-size: 1rem;
                color: #555;
                margin-bottom: 8px;
                font-weight: 600;
            }

            .event-location {
                font-size: 0.95rem;
                color: #777;
                margin: 0;
                display: flex;
                align-items: flex-start;
                gap: 8px;
            }

            .event-location i {
                color: #099aa7;
                font-size: 1.1rem;
                margin-top: 2px;
                flex-shrink: 0;
            }

            /* Responsive */
            @media (max-width: 992px) {
                .event-tabs {
                    flex-wrap: wrap;
                    justify-content: center;
                    border-radius: 20px;
                }

                .event-tabs .nav-link {
                    padding: 10px 20px;
                    font-size: 0.85rem;
                }
            }

            @media (max-width: 768px) {
                .event-list {
                    padding: 10px;
                }

                .event-item {
                    padding: 20px;
                }

                .event-name {
                    font-size: 1.2rem;
                }

                .event-datetime {
                    font-size: 0.9rem;
                }

                .event-location {
                    font-size: 0.85rem;
                }

                .event-tabs {
                    padding: 8px;
                    gap: 3px;
                }

                .event-tabs .nav-link {
                    padding: 8px 15px;
                    font-size: 0.8rem;
                }
            }
        </style>

        @include('components.sebaran-lokasi-blade')

        <!-- Nusantara Raya Run Section -->
        <section id="nusantara-run" class="nrr-section section">

            <!-- Decorative background elements -->
            <div class="nrr-bg-accent nrr-bg-accent--left"></div>
            <div class="nrr-bg-accent nrr-bg-accent--right"></div>

            <div class="container" data-aos="fade-up">

                <!-- Section Header -->
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-9 text-center">
                        <span class="nrr-eyebrow" data-aos="fade-down" data-aos-delay="100">30 Agustus 2026 &bull;
                            05.30 – 11.00 WIT</span>
                        <h2 class="nrr-title" data-aos="fade-up" data-aos-delay="150">
                            Nusantara Raya<br><span class="nrr-title-accent">Run</span>
                        </h2>
                        <p class="nrr-subtitle" data-aos="fade-up" data-aos-delay="200">
                            Ajang lari nasional <em>Fort to Fort</em> yang memadukan semangat olahraga,
                            persatuan Nusantara, dan promosi budaya serta pariwisata Ternate — menutup rangkaian
                            Rakernas XII JKPI 2026 dengan penuh energi.
                        </p>
                    </div>
                </div>

                <!-- Route & Info cards -->
                <div class="row gy-4 justify-content-center mb-5">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="nrr-info-card">
                            <div class="nrr-info-icon">
                                <i class="bi bi-signpost-2-fill"></i>
                            </div>
                            <h4 class="nrr-info-label">Rute</h4>
                            <p class="nrr-info-value">Fort to Fort</p>
                            <p class="nrr-info-sub">Benteng Oranje</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="nrr-info-card">
                            <div class="nrr-info-icon">
                                <i class="bi bi-alarm-fill"></i>
                            </div>
                            <h4 class="nrr-info-label">Waktu Acara</h4>
                            <p class="nrr-info-value">05.30 WIT</p>
                            <p class="nrr-info-sub">Minggu, 30 Agustus 2026</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="nrr-info-card">
                            <div class="nrr-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <h4 class="nrr-info-label">Lokasi</h4>
                            <p class="nrr-info-value">Kota Ternate</p>
                            <p class="nrr-info-sub">Maluku Utara, Indonesia</p>
                        </div>
                    </div>

                </div>

                <!-- Highlights strip -->
                <div class="nrr-highlights" data-aos="fade-up" data-aos-delay="300">
                    <div class="nrr-highlight-item">
                        <i class="bi bi-people-fill"></i>
                        <span>Terbuka untuk Umum</span>
                    </div>
                    <div class="nrr-highlight-sep"></div>
                    <div class="nrr-highlight-item">
                        <i class="bi bi-trophy-fill"></i>
                        <span>Hadiah Menarik</span>
                    </div>
                    <div class="nrr-highlight-sep"></div>
                    <div class="nrr-highlight-item">
                        <i class="bi bi-camera-fill"></i>
                        <span>Pemandangan Bersejarah</span>
                    </div>
                    <div class="nrr-highlight-sep"></div>
                    <div class="nrr-highlight-item">
                        <i class="bi bi-flag-fill"></i>
                        <span>Semangat Persatuan Nusantara</span>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center mt-5" data-aos="zoom-in" data-aos-delay="400">
                    <a href="https://widget.etix.co.id/?lan=id&product=ternate-fort-to-fort-harita-nusantara-raya-run-178149830891179"
                        target="_blank" rel="noopener noreferrer" class="nrr-cta-btn">
                        <i class="bi bi-ticket-perforated-fill me-2"></i>
                        Daftar Nusantara Raya Run
                    </a>
                    <p class="nrr-cta-note mt-3">Pendaftaran melalui platform Etix &bull; Slot terbatas</p>
                </div>

            </div>
        </section><!-- /Nusantara Raya Run Section -->

        <style>
            /* ── Nusantara Raya Run Section ────────────────────────────── */
            .nrr-section {
                position: relative;
                overflow: hidden;
                background: #f7fefe;
                padding: 100px 0;
            }

            /* Decorative blobs */
            .nrr-bg-accent {
                position: absolute;
                width: 520px;
                height: 520px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(9, 154, 167, 0.10) 0%, transparent 70%);
                pointer-events: none;
            }

            .nrr-bg-accent--left {
                top: -120px;
                left: -180px;
            }

            .nrr-bg-accent--right {
                bottom: -120px;
                right: -180px;
            }

            /* Eyebrow */
            .nrr-eyebrow {
                display: inline-block;
                background: rgba(9, 154, 167, 0.10);
                color: #099aa7;
                font-size: 0.88rem;
                font-weight: 700;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                padding: 8px 22px;
                border-radius: 50px;
                margin-bottom: 20px;
                border: 1.5px solid rgba(9, 154, 167, 0.25);
            }

            /* Title */
            .nrr-title {
                font-size: 3.4rem;
                font-weight: 900;
                color: #1a2e35;
                line-height: 1.1;
                margin-bottom: 22px;
                letter-spacing: -1px;
            }

            .nrr-title-accent {
                color: #099aa7;
                position: relative;
                display: inline-block;
            }

            .nrr-title-accent::after {
                content: '';
                position: absolute;
                bottom: 4px;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, #099aa7, #05c9d9);
                border-radius: 3px;
                opacity: 0.4;
            }

            /* Subtitle */
            .nrr-subtitle {
                font-size: 1.15rem;
                color: #555;
                line-height: 1.75;
                max-width: 680px;
                margin: 0 auto;
            }

            /* Info Cards */
            .nrr-info-card {
                background: #fff;
                border-radius: 18px;
                padding: 36px 28px;
                text-align: center;
                box-shadow: 0 4px 24px rgba(9, 154, 167, 0.08);
                border: 2px solid transparent;
                transition: all 0.35s ease;
                height: 100%;
            }

            .nrr-info-card:hover {
                border-color: #099aa7;
                transform: translateY(-6px);
                box-shadow: 0 12px 36px rgba(9, 154, 167, 0.16);
            }

            .nrr-info-icon {
                width: 64px;
                height: 64px;
                background: linear-gradient(135deg, #099aa7, #05c9d9);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 18px;
                font-size: 1.6rem;
                color: #fff;
                box-shadow: 0 6px 18px rgba(9, 154, 167, 0.30);
            }

            .nrr-info-label {
                font-size: 0.8rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                color: #099aa7;
                margin-bottom: 6px;
            }

            .nrr-info-value {
                font-size: 1.45rem;
                font-weight: 800;
                color: #1a2e35;
                margin-bottom: 4px;
            }

            .nrr-info-sub {
                font-size: 0.9rem;
                color: #888;
                margin: 0;
            }

            /* Highlights strip */
            .nrr-highlights {
                background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
                border-radius: 16px;
                padding: 28px 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                gap: 0;
                box-shadow: 0 8px 32px rgba(9, 154, 167, 0.30);
            }

            .nrr-highlight-item {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #fff;
                font-size: 0.98rem;
                font-weight: 600;
                padding: 8px 28px;
            }

            .nrr-highlight-item i {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            .nrr-highlight-sep {
                width: 1.5px;
                height: 28px;
                background: rgba(255, 255, 255, 0.3);
            }

            /* CTA */
            .nrr-cta-btn {
                display: inline-block;
                background: linear-gradient(135deg, #099aa7 0%, #05c9d9 100%);
                color: #fff;
                font-size: 1.15rem;
                font-weight: 700;
                padding: 18px 54px;
                border-radius: 50px;
                text-decoration: none;
                box-shadow: 0 10px 36px rgba(9, 154, 167, 0.38);
                transition: all 0.3s ease;
                letter-spacing: 0.3px;
            }

            .nrr-cta-btn:hover {
                color: #fff;
                transform: translateY(-4px);
                box-shadow: 0 18px 50px rgba(9, 154, 167, 0.50);
            }

            .nrr-cta-note {
                font-size: 0.88rem;
                color: #999;
                margin: 0;
            }

            /* Responsive */
            @media (max-width: 992px) {
                .nrr-highlights {
                    gap: 10px;
                    padding: 24px 20px;
                }

                .nrr-highlight-sep {
                    display: none;
                }
            }

            @media (max-width: 768px) {
                .nrr-title {
                    font-size: 2.4rem;
                }

                .nrr-section {
                    padding: 70px 0;
                }

                .nrr-cta-btn {
                    padding: 16px 36px;
                    font-size: 1rem;
                }

                .nrr-highlights {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }
            }
        </style>

        <!-- Galeri Section -->
        <section id="galeri" class="home-about section light-background">
            <div class="container section-title" data-aos="fade-up">
                <h2>Galeri</h2>
                <p>Dokumentasi visual dari persiapan dan kegiatan Rakernas XII JKPI 2026</p>
            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/1.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/1.JPG') }}" alt="Galeri 1"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/2.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/2.JPG') }}" alt="Galeri 2"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/10.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/10.JPG') }}" alt="Galeri 3"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/3.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/3.JPG') }}" alt="Galeri 4"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/4.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/4.JPG') }}" alt="Galeri 5"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/5.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/5.JPG') }}" alt="Galeri 6"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/6.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/6.JPG') }}" alt="Galeri 7"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/7.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/7.JPG') }}" alt="Galeri 8"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/9.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/9.JPG') }}" alt="Galeri 9"
                                    class="img-fluid">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i><span>Lihat Foto</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Galeri Section -->

        <style>
            .gallery-item {
                position: relative;
                overflow: hidden;
                border-radius: 10px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .gallery-item:hover {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                transform: translateY(-5px);
            }

            .gallery-item a {
                display: block;
                position: relative;
                overflow: hidden;
            }

            .gallery-item img {
                width: 100%;
                height: 300px;
                object-fit: cover;
                border-radius: 10px;
                transition: transform 0.5s ease;
            }

            .gallery-item:hover img {
                transform: scale(1.15);
            }

            .gallery-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #099aa73c 0%, #099aa73d 5%);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.4s ease;
                border-radius: 10px;
            }

            .gallery-item:hover .gallery-overlay {
                opacity: 1;
            }

            .gallery-overlay i {
                font-size: 48px;
                color: #ffffff;
                margin-bottom: 10px;
                animation: zoomPulse 1.5s ease-in-out infinite;
            }

            .gallery-overlay span {
                font-size: 16px;
                font-weight: 600;
                color: #ffffff;
                text-transform: uppercase;
                letter-spacing: 1px;
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.3s ease 0.2s;
            }

            .gallery-item:hover .gallery-overlay span {
                opacity: 1;
                transform: translateY(0);
            }

            @keyframes zoomPulse {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            @media (max-width: 768px) {
                .gallery-item img {
                    height: 250px;
                }

                .gallery-overlay i {
                    font-size: 36px;
                }

                .gallery-overlay span {
                    font-size: 14px;
                }
            }

            @media (max-width: 576px) {
                .gallery-item img {
                    height: 200px;
                }
            }

            .gallery-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 3px solid #099aa7;
                border-radius: 10px;
                opacity: 0;
                transform: scale(0.95);
                transition: all 0.3s ease;
                z-index: 1;
                pointer-events: none;
            }

            .gallery-item:hover::before {
                opacity: 1;
                transform: scale(1);
            }
        </style>

        <!-- CTA Final Section -->
        <section id="cta-final" class="call-to-action section"
            style="background: linear-gradient(135deg, rgba(9, 154, 167, 0.95) 0%, rgba(7, 123, 134, 0.95) 100%); position: relative;">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center text-center">
                    <div class="col-lg-12">
                        <div class="content-wrapper" style="color: #fff;">
                            <h2 style="color: #fff; font-size: 3rem; font-weight: 800; margin-bottom: 20px;">Siap
                                Bergabung dengan JKPI 2026?</h2>
                            <p
                                style="font-size: 1.3rem; margin-bottom: 40px; max-width: 800px; margin-left: auto; margin-right: auto;">
                                Mari bersama-sama memperkuat komitmen pelestarian warisan budaya Indonesia. Daftarkan
                                diri Anda sekarang dan jadilah bagian dari gerakan pelestarian pusaka nasional di Kota
                                Rempah Ternate.
                            </p>
                            <div class="action-buttons">
                                <a href="{{ url('/registrasi') }}"
                                    style="background: linear-gradient(135deg, #FFFFFF 0%, #E0E0E0 100%); color: #099aa7; padding: 20px 60px; border-radius: 50px; font-weight: 700; font-size: 1.3rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 12px 45px rgba(255, 255, 255, 0.4); transition: all 0.3s; border: none;">
                                    <i class="bi bi-pencil-square me-2"></i>DAFTAR SEKARANG
                                </a>

                                <a href="{{ url('/buku-panduan') }}"
                                    style="background: rgba(255,255,255,0.25); backdrop-filter: blur(10px); color: #fff; padding: 20px 60px; border-radius: 50px; font-weight: 700; font-size: 1.3rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); border: 2px solid rgba(255,255,255,0.4); transition: all 0.3s;">
                                    <i class="bi bi-download me-2"></i>UNDUH BUKU PANDUAN
                                </a>

                                <a href="{{ url('/logo-download') }}" target="_blank"
                                    style="background: linear-gradient(135deg, #FFFFFF 0%, #E0E0E0 100%); color: #099aa7; padding: 20px 60px; border-radius: 50px; font-weight: 700; font-size: 1.3rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 12px 45px rgba(255, 255, 255, 0.4); transition: all 0.3s; border: none;">
                                    <i class="bi bi-image me-2"></i>UNDUH LOGO
                                </a>
                            </div>
                            <div class="stats-row mt-5"
                                style="display: flex; justify-content: center; gap: 60px; flex-wrap: wrap;">
                                <div class="stat-item">
                                    <div class="stat-number"
                                        style="font-size: 3rem; font-weight: 900; margin-bottom: 5px;">79</div>
                                    <div class="stat-label" style="font-size: 1.1rem; opacity: 0.9;">Kab/Kota Anggota
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number"
                                        style="font-size: 3rem; font-weight: 900; margin-bottom: 5px;">1000+</div>
                                    <div class="stat-label" style="font-size: 1.1rem; opacity: 0.9;">Peserta</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number"
                                        style="font-size: 3rem; font-weight: 900; margin-bottom: 5px;">26–30 Agt</div>
                                    <div class="stat-label" style="font-size: 1.1rem; opacity: 0.9;">2026</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /CTA Final Section -->

    </main>

    @include('partials.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
