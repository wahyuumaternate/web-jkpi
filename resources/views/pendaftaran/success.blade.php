@extends('layouts.main')

@section('title', 'Pendaftaran Berhasil - Rakernas XII JKPI 2026')

@push('styles')
<style>
    .success-section {
        padding: 150px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .success-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 60px;
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: scaleIn 0.5s ease-out;
    }

    .success-icon i {
        font-size: 4rem;
        color: #fff;
    }

    .success-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #28a745;
        margin-bottom: 20px;
    }

    .success-message {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.8;
    }

    .registration-code-box {
        background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
        color: #fff;
        padding: 25px;
        border-radius: 15px;
        margin: 30px 0;
    }

    .registration-code-label {
        font-size: 0.9rem;
        font-weight: 600;
        opacity: 0.9;
        margin-bottom: 10px;
    }

    .registration-code {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: 2px;
        font-family: 'Courier New', monospace;
    }

    .instruction-box {
        background: #f8f9fa;
        border-left: 4px solid #099aa7;
        padding: 20px;
        border-radius: 10px;
        text-align: left;
        margin: 30px 0;
    }

    .instruction-box h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #099aa7;
        margin-bottom: 15px;
    }

    .instruction-box ol {
        margin: 0;
        padding-left: 20px;
    }

    .instruction-box li {
        margin-bottom: 10px;
        color: #666;
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
        .success-card {
            padding: 40px 20px;
        }

        .success-title {
            font-size: 2rem;
        }

        .registration-code {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<section class="success-section">
    <div class="container">
        <div class="success-card" data-aos="fade-up">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>

            <h1 class="success-title">Pendaftaran Berhasil!</h1>

            <p class="success-message">
                Terima kasih telah mendaftar untuk Rakernas XII JKPI 2026 di Kota Ternate. 
                Pendaftaran Anda telah kami terima dan akan segera diproses.
            </p>

            @if(session('kode_registrasi'))
            <div class="registration-code-box">
                <div class="registration-code-label">KODE REGISTRASI ANDA</div>
                <div class="registration-code">{{ session('kode_registrasi') }}</div>
            </div>
            @endif

            <div class="instruction-box">
                <h4><i class="bi bi-info-circle me-2"></i>Langkah Selanjutnya:</h4>
                <ol>
                    <li>Silakan cek email Anda untuk link verifikasi</li>
                    <li>Klik link verifikasi yang kami kirimkan</li>
                    <li>Simpan kode registrasi Anda untuk keperluan administrasi</li>
                    <li>Kami akan mengirimkan informasi lebih lanjut melalui email</li>
                </ol>
            </div>

            <p style="color: #dc3545; font-weight: 600; margin-bottom: 30px;">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Jika email tidak ditemukan, silakan cek folder Spam/Junk
            </p>

            <a href="{{ url('/') }}" class="btn btn-home">
                <i class="bi bi-house-fill me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection