@extends('layouts.app')

@section('title', 'Detail Servis')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h1 class="page-title">Detail Servis</h1>
        <p class="page-subtitle">Informasi lengkap nomor servis <span class="fw-semibold text-primary">{{ $servis->nomor_servis }}</span></p>
    </div>
    <div class="mt-3 mt-md-0 d-flex gap-2 flex-wrap">
        @if($servis->status->value === 'Selesai')
            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $servis->no_hp) }}?text=Halo {{ $servis->nama_konsumen }}, laptop Anda ({{ $servis->type_laptop }}) dengan nomor servis *{{ $servis->nomor_servis }}* sudah *SELESAI* diperbaiki dan siap diambil di {{ $pengaturan->nama_toko ?? 'Defkan Computer' }}. Terima kasih." 
               class="btn btn-success" target="_blank">
                <i class="fa-brands fa-whatsapp"></i> Kirim Notifikasi WA
            </a>
        @endif
        <a href="{{ route('servis.print', $servis->id) }}" class="btn btn-primary" target="_blank">
            <i class="fa-solid fa-print"></i> Cetak Nota
        </a>
        <a href="{{ route('servis.edit', $servis->id) }}" class="btn btn-warning text-white">
            <i class="fa-solid fa-pen"></i> Edit
        </a>
        <a href="{{ route('servis.index') }}" class="btn btn-light">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column - Main Info -->
    <div class="col-lg-8">
        <!-- Info Perangkat -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fa-solid fa-laptop me-2 text-primary"></i>
                    Informasi Perangkat
                </span>
                @php
                    $badgeClass = 'bg-masuk';
                    if($servis->status instanceof \App\Enums\ServisStatus) {
                        $badgeClass = $servis->status->badgeClass();
                    }
                    $badgeClass = str_replace('badge-', 'bg-', $badgeClass);
                @endphp
                <span class="badge {{ $badgeClass }} px-3 py-2">
                    {{ $servis->status instanceof \App\Enums\ServisStatus ? $servis->status->label() : $servis->status }}
                </span>
            </div>
            <div class="card-body">
                <!-- Laptop Type -->
                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-semibold d-block mb-1">Tipe / Merk Laptop</label>
                    <h4 class="fw-bold text-primary mb-0">{{ $servis->type_laptop }}</h4>
                </div>
                
                <!-- Kerusakan -->
                <div class="bg-light p-3 rounded-3 border mb-4">
                    <label class="text-muted small text-uppercase fw-semibold d-block mb-2">Kerusakan & Keluhan</label>
                    <p class="mb-0 fs-5 lh-base">{{ $servis->jenis_kerusakan }}</p>
                </div>

                <div class="row g-4">
                    <!-- Kelengkapan -->
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block mb-2">Kelengkapan Perangkat</label>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge {{ $servis->kelengkapan_laptop ? 'bg-primary' : 'bg-light text-muted border' }}">
                                <i class="fa-solid fa-{{ $servis->kelengkapan_laptop ? 'check' : 'xmark' }} me-1"></i> Laptop
                            </span>
                            <span class="badge {{ $servis->kelengkapan_charger ? 'bg-primary' : 'bg-light text-muted border' }}">
                                <i class="fa-solid fa-{{ $servis->kelengkapan_charger ? 'check' : 'xmark' }} me-1"></i> Charger
                            </span>
                            <span class="badge {{ $servis->kelengkapan_baterai ? 'bg-primary' : 'bg-light text-muted border' }}">
                                <i class="fa-solid fa-{{ $servis->kelengkapan_baterai ? 'check' : 'xmark' }} me-1"></i> Baterai
                            </span>
                            <span class="badge {{ $servis->kelengkapan_tas ? 'bg-primary' : 'bg-light text-muted border' }}">
                                <i class="fa-solid fa-{{ $servis->kelengkapan_tas ? 'check' : 'xmark' }} me-1"></i> Tas
                            </span>
                            @if($servis->kelengkapan_lainnya)
                                <span class="badge bg-secondary">
                                    <i class="fa-solid fa-plus me-1"></i> {{ $servis->kelengkapan_lainnya }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Teknisi -->
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block mb-2">Teknisi</label>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                                <i class="fa-solid fa-user-gear"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $servis->nama_teknisi }}</div>
                                @if($servis->catatan_teknisi)
                                    <small class="text-muted">{{ $servis->catatan_teknisi }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Sidebar Info -->
    <div class="col-lg-4">
        <!-- Data Pelanggan -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-user me-2 text-primary"></i>
                Data Pelanggan
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small text-uppercase fw-semibold d-block mb-1">Nama Pelanggan</label>
                    <div class="fw-semibold fs-5">{{ $servis->nama_konsumen }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small text-uppercase fw-semibold d-block mb-1">No. WhatsApp</label>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $servis->no_hp) }}" 
                       class="text-success text-decoration-none fw-semibold fs-5" target="_blank">
                        <i class="fa-brands fa-whatsapp me-1"></i> {{ $servis->no_hp }}
                    </a>
                </div>
                <hr>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block mb-1">Tgl Masuk</label>
                        <div class="fw-medium">{{ $servis->tanggal_masuk->format('d M Y') }}</div>
                    </div>
                    <div class="col-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block mb-1">Estimasi Selesai</label>
                        <div class="fw-medium">{{ $servis->tanggal_jadi ? $servis->tanggal_jadi->format('d M Y') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rincian Biaya -->
        <div class="card mb-4 border-start border-4 border-success">
            <div class="card-header">
                <i class="fa-solid fa-receipt me-2 text-success"></i>
                Rincian Biaya
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Biaya</span>
                    <span class="fw-semibold">{{ $servis->formatRupiah($servis->total_biaya) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Sudah Dibayar (DP)</span>
                    <span class="badge bg-success">{{ $servis->formatRupiah($servis->panjar) }}</span>
                </div>
                <hr>
                <div class="bg-light p-3 rounded-3 d-flex justify-content-between align-items-center">
                    <span class="fw-semibold text-uppercase small">Sisa Pembayaran</span>
                    <span class="fw-bold fs-5 text-danger">{{ $servis->formatRupiah($servis->total_biaya - $servis->panjar) }}</span>
                </div>
            </div>
        </div>

        <!-- Garansi -->
        <div class="card">
            <div class="card-header">
                <i class="fa-solid fa-shield-halved me-2 text-info"></i>
                Garansi
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle me-3">
                        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-semibold">Masa Garansi</div>
                        <div class="fs-4 fw-bold text-info">{{ $servis->getGaransiText() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
