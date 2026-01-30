@extends('layouts.user')

@section('title', 'Beranda')

@section('styles')
<style>
    /* Mobile Responsive Fixes */
    .hero-section h1 {
        font-size: 1.5rem;
    }
    .hero-section .lead {
        font-size: 0.95rem;
    }
    .hero-logo {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: contain;
        background: white;
    }
    
    /* Feature Cards - Compact for mobile */
    .feature-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        height: 100%;
    }
    .feature-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    .feature-title {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .feature-desc {
        font-size: 0.8rem;
        color: #64748B;
        margin: 0;
        line-height: 1.4;
    }
    
    /* Procedure Section */
    .procedure-step {
        text-align: center;
        padding: 1rem 0.5rem;
    }
    .step-number {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
    }
    .step-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 0.75rem;
        margin-bottom: 0.25rem;
    }
    .step-desc {
        font-size: 0.75rem;
        color: #64748B;
        margin: 0;
    }
    
    /* Contact Section */
    .contact-section {
        padding: 1.25rem;
    }
    .contact-section h5 {
        font-size: 1rem;
    }
    .contact-section p {
        font-size: 0.85rem;
    }
    .contact-section .btn {
        font-size: 0.9rem;
        padding: 0.625rem 1.25rem;
    }
    
    @media (min-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }
        .hero-section .lead {
            font-size: 1.1rem;
        }
        .hero-logo {
            width: 100px;
            height: 100px;
        }
        .feature-card {
            padding: 1.5rem;
        }
        .feature-icon {
            width: 56px;
            height: 56px;
            font-size: 1.5rem;
        }
        .feature-title {
            font-size: 1rem;
        }
        .feature-desc {
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
            <div class="mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="hero-logo">
            </div>
            <h1 class="fw-bold text-primary mb-2">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</h1>
            <p class="lead text-muted mb-3">Spesialis Servis Laptop Profesional & Terpercaya</p>
            <a href="{{ route('tracking.index') }}" class="btn btn-primary px-4 py-2">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Cek Status Servis
            </a>
        </div>

        <!-- Features - Vertical Layout -->
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="feature-card d-flex align-items-center gap-3">
                    <div class="feature-icon bg-primary bg-opacity-10 text-primary flex-shrink-0">
                        <i class="fa-solid fa-tools"></i>
                    </div>
                    <div>
                        <h6 class="feature-title">Teknisi Berpengalaman</h6>
                        <p class="feature-desc">Tim teknisi profesional dengan pengalaman bertahun-tahun</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="feature-card d-flex align-items-center gap-3">
                    <div class="feature-icon bg-success bg-opacity-10 text-success flex-shrink-0">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h6 class="feature-title">Garansi Servis</h6>
                        <p class="feature-desc">Garansi untuk setiap perbaikan yang kami lakukan</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="feature-card d-flex align-items-center gap-3">
                    <div class="feature-icon bg-info bg-opacity-10 text-info flex-shrink-0">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h6 class="feature-title">Cepat & Transparan</h6>
                        <p class="feature-desc">Pantau status servis kapan saja secara online</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="card border-0 bg-light mb-4">
            <div class="card-body p-3 p-md-4">
                <h5 class="fw-bold text-center mb-3" style="font-size: 1rem;">Cara Cek Status Servis</h5>
                <div class="row g-2">
                    <div class="col-4">
                        <div class="procedure-step">
                            <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">
                                <span class="fw-bold">1</span>
                            </div>
                            <div class="step-title">Siapkan Nota</div>
                            <p class="step-desc d-none d-md-block">Lihat nomor servis di nota yang Anda terima</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="procedure-step">
                            <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">
                                <span class="fw-bold">2</span>
                            </div>
                            <div class="step-title">Input Nomor</div>
                            <p class="step-desc d-none d-md-block">Masukkan nomor servis di halaman cek status</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="procedure-step">
                            <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center">
                                <span class="fw-bold">3</span>
                            </div>
                            <div class="step-title">Lihat Status</div>
                            <p class="step-desc d-none d-md-block">Pantau progress perbaikan laptop Anda</p>
                        </div>
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
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
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
