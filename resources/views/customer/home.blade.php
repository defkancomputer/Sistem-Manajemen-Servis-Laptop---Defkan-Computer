@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Hero Section -->
        <div class="text-center mb-5 py-4">
            <div class="mb-4">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="width: 100px; height: 100px; border-radius: 16px;">
            </div>
            <h1 class="display-5 fw-bold text-primary mb-3">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</h1>
            <p class="lead text-muted mb-4">Spesialis Servis Laptop Profesional & Terpercaya</p>
            <a href="{{ route('tracking.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Cek Status Servis
            </a>
        </div>

        <!-- Features -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body py-4">
                        <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                             style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-tools fa-xl text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Teknisi Berpengalaman</h5>
                        <p class="text-muted mb-0">Tim teknisi profesional dengan pengalaman bertahun-tahun</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body py-4">
                        <div class="bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                             style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-shield-halved fa-xl text-success"></i>
                        </div>
                        <h5 class="fw-bold">Garansi Servis</h5>
                        <p class="text-muted mb-0">Garansi untuk setiap perbaikan yang kami lakukan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm">
                    <div class="card-body py-4">
                        <div class="bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                             style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-clock fa-xl text-info"></i>
                        </div>
                        <h5 class="fw-bold">Cepat & Transparan</h5>
                        <p class="text-muted mb-0">Pantau status servis kapan saja secara online</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="card border-0 bg-light mb-5">
            <div class="card-body p-4 p-md-5">
                <h4 class="fw-bold text-center mb-4">Cara Cek Status Servis</h4>
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 48px; height: 48px;">
                            <span class="fw-bold">1</span>
                        </div>
                        <h6 class="fw-bold">Siapkan Nota</h6>
                        <p class="text-muted small mb-0">Lihat nomor servis di nota yang Anda terima</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 48px; height: 48px;">
                            <span class="fw-bold">2</span>
                        </div>
                        <h6 class="fw-bold">Input Nomor</h6>
                        <p class="text-muted small mb-0">Masukkan nomor servis di halaman cek status</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 48px; height: 48px;">
                            <span class="fw-bold">3</span>
                        </div>
                        <h6 class="fw-bold">Lihat Status</h6>
                        <p class="text-muted small mb-0">Pantau progress perbaikan laptop Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="card border-0 bg-primary text-white">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-2">Butuh Bantuan?</h5>
                        <p class="mb-0 opacity-75">
                            <i class="fa-solid fa-location-dot me-2"></i>{{ $pengaturan->alamat ?? 'Alamat belum diatur' }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaturan->no_kontak ?? '') }}" 
                           class="btn btn-light btn-lg" target="_blank">
                            <i class="fa-brands fa-whatsapp me-2 text-success"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
