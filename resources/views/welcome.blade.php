<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Rakernas XII JKPI 2026 - Ternate</title>

    <meta name="description" content="Website Resmi Rakernas XII JKPI 2026 - Pusaka Ternate, Pusaka Dunia">
    <meta name="keywords"
        content="JKPI 2026, Rakernas JKPI, Jaringan Kota Pusaka Indonesia, Kota Ternate, Warisan Budaya, Pelestarian Pusaka">

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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .heritage-site {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .market-area {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .workshop-room {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stage-culture {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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
    </style>
</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top ">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <!-- Logo Group -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('logo-jkpi.png') }}" alt="JKPI 2026">
                </a>

                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('logo_kota.png') }}" alt="Kota Ternate">
                </a>

                {{-- <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('assets/img/logo-partner.png') }}" alt="Partner Resmi">
                </a> --}}
            </div>

            <!-- Navigation -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#tujuan">Tujuan</a></li>
                    <li><a href="#rangkaian">Rangkaian Kegiatan</a></li>
                    <li><a href="#buku-panduan">Buku Panduan</a></li>
                    <li><a href="#sebaran-lokasi">Sebaran Lokasi</a></li>
                    <li><a href="#galeri">Galeri</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- CTA -->
            <a class="btn-getstarted" href="{{ url('/registrasi') }}">Registrasi</a>

        </div>
    </header>



    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section"
            style="background: linear-gradient(135deg, rgba(9, 154, 167, 0.302) 0%, rgba(7, 123, 134, 0.92) 100%), url('{{ asset('culture3.jpg') }}') center/cover no-repeat; min-height: 100vh; position: relative; overflow: hidden; background-blend-mode: multiply;">

            <!-- Sketch Overlay - Subtle Background -->
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('{{ asset('culture3.jpg') }}') center/cover no-repeat; opacity: 0.12; mix-blend-mode: overlay; filter: contrast(1.05) brightness(1.0);">
            </div>

            <!-- Subtle Pattern -->
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.02) 35px, rgba(255,255,255,.02) 70px); animation: slide 20s linear infinite;">
            </div>

            <!-- Vignette Effect for Focus -->
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(ellipse at center, transparent 20%, rgba(0,0,0,0.2) 100%);">
            </div>

            <div class="container" style="position: relative; z-index: 2;">
                <div class="row align-items-center" style="min-height: 90vh;">
                    <div class="col-lg-12 text-center">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">

                            <!-- Badge -->
                            <div class="badge-container mb-4" data-aos="zoom-in" data-aos-delay="300">
                                <span
                                    style="background: rgba(255, 255, 255, 0.30); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); color: #fff; padding: 12px 30px; border-radius: 50px; font-weight: 600; font-size: 0.95rem; letter-spacing: 1px; border: 2px solid rgba(255,255,255,0.5); box-shadow: 0 8px 32px rgba(0,0,0,0.3); display: inline-block;">
                                    <i class="bi bi-geo-alt-fill me-2"></i>RAKERNAS XII JARINGAN KOTA PUSAKA INDONESIA
                                </span>
                            </div>

                            <!-- Main Title -->
                            <h1 data-aos="fade-up" data-aos-delay="400"
                                style="color: #fff; font-size: 4.5rem; font-weight: 900; text-shadow: 3px 3px 20px rgba(0,0,0,0.5), 1px 1px 8px rgba(0,0,0,0.7); margin-bottom: 30px; line-height: 1.2; letter-spacing: -1px;">
                                PUSAKA TERNATE<br>
                                <span
                                    style="color: #FFFFFF; font-size: 5rem; text-shadow: 3px 3px 20px rgba(0,0,0,0.5), 1px 1px 8px rgba(0,0,0,0.7), 0 0 20px rgba(255,255,255,0.3);">PUSAKA
                                    DUNIA</span>
                            </h1>

                            <!-- Subtitle -->
                            <p data-aos="fade-up" data-aos-delay="500"
                                style="color: rgba(255,255,255,0.98); font-size: 1.4rem; max-width: 900px; margin: 0 auto 50px; line-height: 1.8; text-shadow: 2px 2px 12px rgba(0,0,0,0.5), 1px 1px 4px rgba(0,0,0,0.7); font-weight: 400;">
                                Kota Ternate dengan bangga menjadi tuan rumah Rakernas XII JKPI 2026<br>
                                <strong style="font-weight: 700;">Memperkenalkan Warisan Kesultanan & Kekayaan Rempah
                                    Nusantara</strong>
                            </p>

                            <!-- CTA Buttons -->
                            <div data-aos="fade-up" data-aos-delay="700" style="margin-bottom: 40px;">
                                <a href="{{ url('/registrasi') }}"
                                    style="background: linear-gradient(135deg, #FFFFFF 0%, #E0E0E0 100%); color: #099aa7; padding: 18px 50px; border-radius: 50px; font-weight: 700; font-size: 1.2rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 12px 45px rgba(255, 255, 255, 0.4), 0 5px 15px rgba(0,0,0,0.3); transition: all 0.3s; border: none;">
                                    <i class="bi bi-pencil-square me-2"></i>DAFTAR SEKARANG
                                </a>
                                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox"
                                    style="background: rgba(255,255,255,0.30); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); color: #fff; padding: 18px 50px; border-radius: 50px; font-weight: 700; font-size: 1.2rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 12px 45px rgba(0,0,0,0.3), 0 5px 15px rgba(255,255,255,0.1); border: 2px solid rgba(255,255,255,0.5); transition: all 0.3s;">
                                    <i class="bi bi-play-circle me-2"></i>TONTON VIDEO
                                </a>
                            </div>

                            <!-- Quick Links -->
                            <div data-aos="fade-up" data-aos-delay="800"
                                style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
                                <a href="#rangkaian"
                                    style="color: #fff; text-decoration: none; font-size: 1rem; font-weight: 600; transition: all 0.3s; text-shadow: 2px 2px 6px rgba(0,0,0,0.5);">
                                    <i class="bi bi-calendar-check me-2"></i>Rangkaian Kegiatan
                                </a>
                                <a href="#buku-panduan"
                                    style="color: #fff; text-decoration: none; font-size: 1rem; font-weight: 600; transition: all 0.3s; text-shadow: 2px 2px 6px rgba(0,0,0,0.5);">
                                    <i class="bi bi-download me-2"></i>Buku Panduan
                                </a>
                                <a href="#galeri"
                                    style="color: #fff; text-decoration: none; font-size: 1rem; font-weight: 600; transition: all 0.3s; text-shadow: 2px 2px 6px rgba(0,0,0,0.5);">
                                    <i class="bi bi-images me-2"></i>Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Down Indicator -->
            <div data-aos="fade-up" data-aos-delay="900"
                style="position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); z-index: 3; text-align: center;">
                <p
                    style="color: rgba(255,255,255,0.98); font-size: 0.9rem; margin-bottom: 10px; font-weight: 600; text-shadow: 2px 2px 6px rgba(0,0,0,0.5);">
                    Scroll untuk melihat lebih banyak</p>
                <i class="bi bi-chevron-down"
                    style="color: #FFFFFF; font-size: 2rem; animation: bounce 2s infinite; filter: drop-shadow(2px 2px 6px rgba(0,0,0,0.5));"></i>
            </div>

            <style>
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
            </style>
        </section><!-- /Hero Section -->

        <!-- Tentang JKPI Section -->
        <section id="tentang" class="home-about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="150">
                        <h2 class="section-heading">Tentang JKPI</h2>
                        <p class="lead-description">Jaringan Kota Pusaka Indonesia (JKPI) adalah organisasi yang
                            menghimpun kota-kota di Indonesia yang memiliki warisan budaya dan sejarah untuk
                            bersama-sama melestarikan, mengelola, dan mengembangkan potensi pusaka sebagai aset
                            pembangunan berkelanjutan.</p>
                    </div>
                </div>

                <div class="row align-items-center gy-5">
                    <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
                        <div class="image-grid">
                            <div class="primary-image">
                                <img src="{{ asset('assets/img/JKPI-2025/1.JPG') }}" alt="JKPI 2026"
                                    class="img-fluid">
                                {{-- <div class="certification-badge">
                                    <i class="bi bi-award"></i>
                                    <span>Warisan Kesultanan</span>
                                </div> --}}
                            </div>
                            <div class="secondary-images">
                                <div class="small-image">
                                    {{-- public/assets/img/JKPI-2025/1.JPG --}}
                                    <img src="{{ asset('assets/img/JKPI-2025/2.JPG') }}" alt="Diskusi Pelestarian"
                                        class="img-fluid">
                                </div>
                                <div class="small-image">
                                    <img src="{{ asset('assets/img/JKPI-2025/3.JPG') }}" alt="Workshop Budaya"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="300">
                        <div class="content-wrapper">
                            <div class="highlight-box">
                                <div class="highlight-icon">
                                    <i class="bi bi-heart-pulse-fill"></i>
                                </div>
                                <div class="highlight-content">
                                    <h4>Ternate: Dari Kota Pusaka Menuju Kota Rempah</h4>
                                    <p>Pemerintah Kota Ternate resmi menerima Pataka JKPI dari Wali Kota Yogyakarta
                                        sebagai simbol pergantian tuan rumah Rakernas JKPI 2026.</p>
                                </div>
                            </div>

                            <div class="feature-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Pelestarian warisan Kesultanan Ternate dan rempah-rempah
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Simposium Pulau-Pulau Penghasil Rempah Internasional
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="feature-text">Kolaborasi Ternate, Tidore, dan Halmahera Barat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Tentang JKPI Section -->

        <!-- Tujuan Penyelenggaraan Section -->
        <section id="tujuan" class="featured-services section light-background">

            <div class="container section-title" data-aos="fade-up">
                <h2>Tujuan Penyelenggaraan JKPI</h2>
                <p>Rakernas XII JKPI 2026 diselenggarakan dengan berbagai tujuan strategis untuk kemajuan pelestarian
                    pusaka Indonesia</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
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
                            <div class="service-icon">
                                <i class="fas fa-users"></i>
                            </div>
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
                            <div class="service-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="service-content">
                                <h3>Mengembangkan Ekonomi Kreatif</h3>
                                <p>Mendorong pertumbuhan UMKM dan ekonomi kreatif lokal melalui promosi produk unggulan
                                    berbasis budaya dan pengembangan pasar berkelanjutan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="service-content">
                                <h3>Edukasi dan Pelatihan</h3>
                                <p>Menyelenggarakan seminar dan workshop tentang konservasi pusaka, arsitektur heritage,
                                    dan pemberdayaan masyarakat dalam pelestarian budaya.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="service-content">
                                <h3>Kerjasama Internasional</h3>
                                <p>Membangun jaringan kerjasama dengan organisasi internasional dan negara lain dalam
                                    pelestarian warisan budaya dan pertukaran knowledge.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
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
                        <p class="lead-description">JKPI menghubungkan 58+ kabupaten dan kota di seluruh Indonesia yang
                            memiliki komitmen kuat dalam pelestarian warisan budaya dan pengembangan kota berbasis
                            pusaka.</p>
                    </div>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item text-center">
                            <div class="stat-number"
                                style="font-size: 3rem; font-weight: 800; color: #099aa7; margin-bottom: 10px;">
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="58"
                                    data-purecounter-duration="1">58</span>+
                            </div>
                            <div class="stat-label" style="font-size: 1.1rem; color: #666;">Kota Anggota JKPI</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-item text-center">
                            <div class="stat-number"
                                style="font-size: 3rem; font-weight: 800; color: #099aa7; margin-bottom: 10px;">
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="34"
                                    data-purecounter-duration="1">34</span>
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
                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="15"
                                    data-purecounter-duration="1">15</span>+
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
                <p>Berbagai agenda dan kegiatan yang akan memperkaya pengalaman peserta dalam melestarikan pusaka budaya
                </p>
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
                                        strategis memperkenalkan kualitas cengkeh dan rempah Ternate yang
                                        tak tertandingi.</p>
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
                                        <img src="{{ asset('assets/img/JKPI-2025/4.JPG') }}" alt="Simposium Rempah"
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="departments-grid">
                        <div class="row">
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Sidang Pleno JKPI</h3>
                                        <p class="card-description">Forum diskusi nasional yang mempertemukan kepala
                                            daerah dan pemangku kepentingan dari 58 kabupaten/kota anggota JKPI.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">58+</span>
                                                <span class="stat-label">Peserta</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">5</span>
                                                <span class="stat-label">Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Heritage Tour</h3>
                                        <p class="card-description">Kunjungan ke situs-situs bersejarah di Ternate,
                                            Tidore, dan Halmahera Barat untuk melihat langsung pelestarian warisan
                                            Kesultanan.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">15+</span>
                                                <span class="stat-label">Lokasi</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">3</span>
                                                <span class="stat-label">Kota</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Pasar Malam Indonesia</h3>
                                        <p class="card-description">Pameran UMKM dan produk unggulan dari seluruh
                                            Indonesia, tersebar hingga ke kecamatan dan Pulau Hiri.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">100+</span>
                                                <span class="stat-label">UMKM</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">58</span>
                                                <span class="stat-label">Daerah</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="450">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-theater-masks"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Pentas Seni Budaya</h3>
                                        <p class="card-description">Pertunjukan tari tradisional dari delegasi seluruh
                                            kota pusaka dan kabupaten/kota di Maluku Utara.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">50+</span>
                                                <span class="stat-label">Pertunjukan</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">10+</span>
                                                <span class="stat-label">Kabupaten/Kota</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Seminar & Workshop</h3>
                                        <p class="card-description">Sesi edukatif tentang pelestarian pusaka,
                                            revitalisasi kawasan heritage, dan ekonomi berbasis budaya.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">20+</span>
                                                <span class="stat-label">Narasumber</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">15</span>
                                                <span class="stat-label">Sesi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="550">
                                <div class="department-card">
                                    <div class="card-icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">Festival Kuliner</h3>
                                        <p class="card-description">Promosi kuliner tradisional Maluku Utara dan
                                            seluruh Indonesia, memperkenalkan cita rasa khas warisan budaya.</p>
                                        <div class="card-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">75+</span>
                                                <span class="stat-label">Menu</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">40</span>
                                                <span class="stat-label">Stan Kuliner</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Rangkaian Kegiatan Section -->



        @include('components.sebaran-lokasi-blade')

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
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/2.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/2.JPG') }}" alt="Galeri 2"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/10.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/10.JPG') }}" alt="Galeri 3"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/3.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/3.JPG') }}" alt="Galeri 4"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/4.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/4.JPG') }}" alt="Galeri 5"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/5.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/5.JPG') }}" alt="Galeri 6"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/6.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/6.JPG') }}" alt="Galeri 4"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/7.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/7.JPG') }}" alt="Galeri 5"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="gallery-item">
                            <a href="{{ asset('assets/img/JKPI-2025/9.JPG') }}" class="glightbox">
                                <img src="{{ asset('assets/img/JKPI-2025/9.JPG') }}" alt="Galeri 6"
                                    class="img-fluid"
                                    style="border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Galeri Section -->

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
                                Rempah Ternate.</p>

                            <div class="action-buttons">
                                <a href="{{ url('/registrasi') }}"
                                    style="background: linear-gradient(135deg, #FFFFFF 0%, #E0E0E0 100%); color: #099aa7; padding: 20px 60px; border-radius: 50px; font-weight: 700; font-size: 1.3rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 12px 45px rgba(255, 255, 255, 0.4); transition: all 0.3s; border: none;">
                                    <i class="bi bi-pencil-square me-2"></i>DAFTAR SEKARANG
                                </a>
                                <a href="#buku-panduan"
                                    style="background: rgba(255,255,255,0.25); backdrop-filter: blur(10px); color: #fff; padding: 20px 60px; border-radius: 50px; font-weight: 700; font-size: 1.3rem; text-decoration: none; display: inline-block; margin: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); border: 2px solid rgba(255,255,255,0.4); transition: all 0.3s;">
                                    <i class="bi bi-download me-2"></i>UNDUH BUKU PANDUAN
                                </a>
                            </div>

                            <div class="stats-row mt-5"
                                style="display: flex; justify-content: center; gap: 60px; flex-wrap: wrap;">
                                <div class="stat-item">
                                    <div class="stat-number"
                                        style="font-size: 3rem; font-weight: 900; margin-bottom: 5px;">58+</div>
                                    <div class="stat-label" style="font-size: 1.1rem; opacity: 0.9;">Kota Anggota
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number"
                                        style="font-size: 3rem; font-weight: 900; margin-bottom: 5px;">1000+</div>
                                    <div class="stat-label" style="font-size: 1.1rem; opacity: 0.9;">Peserta</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number"
                                        style="font-size: 3rem; font-weight: 900; margin-bottom: 5px;">Agustus</div>
                                    <div class="stat-label" style="font-size: 1.1rem; opacity: 0.9;">2026</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /CTA Final Section -->

    </main>

    <footer id="footer" class="footer position-relative">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <span class="sitename">JKPI 2026</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Sekretariat Panitia Rakernas XII JKPI 2026</p>
                        <p>Pemerintah Kota Ternate, Maluku Utara</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>+62 921 123 456</span></p>
                        <p><strong>Email:</strong> <span>info@jkpiternate2026.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Menu Utama</h4>
                    <ul>
                        <li><a href="#hero">Beranda</a></li>
                        <li><a href="#tentang">Tentang JKPI</a></li>
                        <li><a href="#tujuan">Tujuan</a></li>
                        <li><a href="#rangkaian">Rangkaian Kegiatan</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Program Unggulan</h4>
                    <ul>
                        <li><a href="#rangkaian">Simposium Rempah</a></li>
                        <li><a href="#rangkaian">Heritage Tour</a></li>
                        <li><a href="#rangkaian">Pasar Malam Indonesia</a></li>
                        <li><a href="#rangkaian">Pentas Seni Budaya</a></li>
                        <li><a href="#rangkaian">Festival Kuliner</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Informasi</h4>
                    <ul>
                        <li><a href="#buku-panduan">Buku Panduan</a></li>
                        <li><a href="#sebaran-lokasi">Sebaran Lokasi</a></li>
                        <li><a href="#galeri">Galeri</a></li>
                        <li><a href="{{ url('/registrasi') }}">Registrasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Mitra Kerja</h4>
                    <ul>
                        <li><a href="#">Pemerintah Kota Ternate</a></li>
                        <li><a href="#">Kota Tidore Kepulauan</a></li>
                        <li><a href="#">Kabupaten Halmahera Barat</a></li>
                        <li><a href="#">Kesultanan Ternate</a></li>
                        <li><a href="#">JKPI Pusat</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong>Rakernas XII JKPI 2026 Kota Ternate</strong>&nbsp;<span>All Rights
                    Reserved</span></p>
            <div class="credits">
                Dikelola oleh Panitia Rakernas XII JKPI 2026 Kota Ternate
            </div>
        </div>

    </footer>

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
