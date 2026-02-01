@extends('layouts.main')

@section('title', 'Email Terverifikasi - Rakernas XII JKPI 2026')

@push('styles')
    <style>
        .verified-section {
            padding: 150px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .verified-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 60px;
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .verified-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: scaleIn 0.5s ease-out;
        }

        .verified-icon i {
            font-size: 4rem;
            color: #fff;
        }

        .verified-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #099aa7;
            margin-bottom: 20px;
        }

        .verified-message {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .participant-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            text-align: left;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            font-weight: 700;
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .btn-home {
            background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
            color: #fff;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(9, 154, 167, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(9, 154, 167, 0.4);
            color: #fff;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .verified-card {
                padding: 40px 20px;
            }

            .verified-title {
                font-size: 2rem;
            }

            .participant-info {
                padding: 20px;
            }

            .info-row {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="verified-section">
        <div class="container">
            <div class="verified-card" data-aos="fade-up">
                <div class="verified-icon">
                    <i class="bi bi-shield-fill-check"></i>
                </div>

                <h1 class="verified-title">Email Terverifikasi!</h1>

                <p class="verified-message">
                    Selamat! Email Anda telah berhasil diverifikasi.
                    Pendaftaran Anda untuk Rakernas XII JKPI 2026 telah dikonfirmasi.
                </p>

                <div class="participant-info">
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap:</span>
                        <span class="info-value">{{ $peserta->nama_lengkap }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $peserta->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Kode Registrasi:</span>
                        <span class="info-value">{{ $peserta->kode_registrasi }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status:</span>
                        <span class="status-badge">
                            <i class="bi bi-check-circle me-1"></i>Terverifikasi
                        </span>
                    </div>
                </div>

                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Informasi Penting:</strong><br>
                    Kami akan mengirimkan informasi lebih lanjut mengenai jadwal, lokasi, dan persiapan acara melalui email
                    Anda.
                    Mohon pantau email secara berkala.
                </div>

                <a href="{{ url('/') }}" class="btn btn-home">
                    <i class="bi bi-house-fill me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
@endsection
