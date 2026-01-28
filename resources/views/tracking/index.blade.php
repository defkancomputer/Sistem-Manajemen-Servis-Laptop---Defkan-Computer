@extends('layouts.user')

@section('title', 'Cek Status Servis')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <!-- Hero Section -->
        <div class="text-center mb-5">
            <div class="mb-4">
                <div class="bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle" 
                     style="width: 80px; height: 80px;">
                    <i class="fa-solid fa-magnifying-glass fa-2x text-primary"></i>
                </div>
            </div>
            <h1 class="page-title">Cek Status Servis</h1>
            <p class="text-muted">Masukkan nomor servis untuk melihat status perbaikan laptop Anda</p>
        </div>

        <!-- Search Form -->
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('tracking.show') }}" method="GET">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nomor Servis</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-hashtag text-muted"></i>
                            </span>
                            <input type="text" name="nomor" class="form-control border-start-0" 
                                   placeholder="Contoh: SRV202601270001" 
                                   value="{{ old('nomor') }}" required autofocus>
                        </div>
                        <div class="form-text mt-2">
                            <i class="fa-solid fa-circle-info text-muted me-1"></i>
                            Nomor servis tertera pada nota yang Anda terima saat penyerahan unit
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fa-solid fa-search me-2"></i> Cek Status Sekarang
                    </button>
                </form>
            </div>
        </div>

        <!-- Info Section -->
        <div class="mt-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="text-center p-3">
                        <div class="text-primary mb-2">
                            <i class="fa-solid fa-clock fa-2x"></i>
                        </div>
                        <div class="small text-muted">Pantau real-time</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3">
                        <div class="text-primary mb-2">
                            <i class="fa-solid fa-shield-halved fa-2x"></i>
                        </div>
                        <div class="small text-muted">Aman & Terpercaya</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3">
                        <div class="text-primary mb-2">
                            <i class="fa-brands fa-whatsapp fa-2x"></i>
                        </div>
                        <div class="small text-muted">Notifikasi WA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
