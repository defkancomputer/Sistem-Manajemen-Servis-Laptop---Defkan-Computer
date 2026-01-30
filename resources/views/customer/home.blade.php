@extends('layouts.user')

@section('title', 'Beranda')

@section('styles')
<style>
    /* Mobile Responsive Fixes */
    .hero-section h1 {
        font-size: 1.25rem;
    }
    .hero-section .lead {
        font-size: 0.85rem;
    }
    .hero-logo {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        object-fit: contain;
        background: white;
    }
    .hero-btn {
        font-size: 0.85rem;
        padding: 0.5rem 1.25rem;
    }
    
    /* Feature Cards - Horizontal compact */
    .feature-card {
        background: white;
        border-radius: 10px;
        padding: 0.875rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        height: 100%;
        text-align: center;
    }
    .feature-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }
    .feature-title {
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0;
        line-height: 1.3;
    }
    .feature-desc {
        display: none;
    }
    
    /* Procedure Section */
    .procedure-card {
        padding: 1rem;
    }
    .procedure-title {
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }
    .procedure-step {
        text-align: center;
        padding: 0.5rem 0.25rem;
    }
    .step-number {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    .step-title {
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 0.5rem;
        margin-bottom: 0;
        line-height: 1.3;
    }
    .step-desc {
        display: none;
    }
    
    /* Contact Section */
    .contact-section {
        padding: 1rem;
    }
    .contact-section h5 {
        font-size: 0.9rem;
    }
    .contact-section p {
        font-size: 0.75rem;
    }
    .contact-section .btn {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
    }
    
    @media (min-width: 768px) {
        .hero-section h1 {
            font-size: 1.75rem;
        }
        .hero-section .lead {
            font-size: 1rem;
        }
        .hero-logo {
            width: 90px;
            height: 90px;
        }
        .hero-btn {
            font-size: 0.95rem;
            padding: 0.625rem 1.5rem;
        }
        .feature-card {
            padding: 1.25rem;
        }
        .feature-icon {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }
        .feature-title {
            font-size: 0.9rem;
        }
        .feature-desc {
            display: block;
            font-size: 0.8rem;
            color: #64748B;
            margin-top: 0.375rem;
            margin-bottom: 0;
        }
        .procedure-card {
            padding: 1.5rem;
        }
        .procedure-title {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .step-number {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }
        .step-title {
            font-size: 0.85rem;
            margin-top: 0.75rem;
        }
        .step-desc {
            display: block;
            font-size: 0.75rem;
            color: #64748B;
            margin-top: 0.25rem;
        }
        .contact-section {
            padding: 1.25rem;
        }
        .contact-section h5 {
            font-size: 1rem;
        }
        .contact-section p {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Hero Section -->
        <div class="hero-section text-center mb-4 py-3">
            <div class="mb-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="hero-logo">
            </div>
            <h1 class="fw-bold text-primary mb-1">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</h1>
            <p class="lead text-muted mb-3">Spesialis Servis Laptop Profesional & Terpercaya</p>
            <a href="{{ route('tracking.index') }}" class="btn btn-primary hero-btn">
                <i class="fa-solid fa-magnifying-glass me-1"></i> Cek Status Servis
            </a>
        </div>

        <!-- Features - Horizontal Layout -->
        <div class="row g-2 mb-3">
            <div class="col-4">
                <div class="feature-card">
                    <div class="feature-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fa-solid fa-tools"></i>
                    </div>
                    <h6 class="feature-title">Teknisi Berpengalaman</h6>
                    <p class="feature-desc">Tim profesional dengan pengalaman bertahun-tahun</p>
                </div>
            </div>
            <div class="col-4">
                <div class="feature-card">
                    <div class="feature-icon bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h6 class="feature-title">Garansi Servis</h6>
                    <p class="feature-desc">Garansi untuk setiap perbaikan</p>
                </div>
            </div>
            <div class="col-4">
                <div class="feature-card">
                    <div class="feature-icon bg-info bg-opacity-10 text-info">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h6 class="feature-title">Cepat & Transparan</h6>
                    <p class="feature-desc">Pantau status servis secara online</p>
                </div>
            </div>
        </div>

        <!-- How It Works - Horizontal -->
        <div class="card border-0 bg-light mb-3 procedure-card">
            <h5 class="fw-bold text-center procedure-title">Cara Cek Status Servis</h5>
            <div class="row g-1">
                <div class="col-4">
                    <div class="procedure-step">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">
                            <span class="fw-bold">1</span>
                        </div>
                        <div class="step-title">Siapkan Nota</div>
                        <p class="step-desc">Lihat nomor servis di nota</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="procedure-step">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">
                            <span class="fw-bold">2</span>
                        </div>
                        <div class="step-title">Input Nomor</div>
                        <p class="step-desc">Masukkan nomor di halaman cek</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="procedure-step">
                        <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">
                            <span class="fw-bold">3</span>
                        </div>
                        <div class="step-title">Lihat Status</div>
                        <p class="step-desc">Pantau progress perbaikan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="card border-0 bg-primary text-white">
            <div class="card-body contact-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-1">Butuh Bantuan?</h5>
                        <p class="mb-0 opacity-75">
                            <i class="fa-solid fa-location-dot me-1"></i>{{ $pengaturan->alamat ?? 'Alamat belum diatur' }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-2 mt-md-0">
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaturan->no_kontak ?? '') }}" 
                           class="btn btn-light" target="_blank">
                            <i class="fa-brands fa-whatsapp me-1 text-success"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
