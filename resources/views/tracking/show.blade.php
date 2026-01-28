@extends('layouts.user')

@section('title', 'Status Servis ' . $servis->nomor_servis)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('tracking.index') }}" class="btn btn-light">
                <i class="fa-solid fa-arrow-left me-2"></i> Cek Nomor Lain
            </a>
        </div>

        <!-- Status Header -->
        <div class="card mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="text-muted small text-uppercase fw-semibold mb-1">Nomor Servis</div>
                        <h2 class="fw-bold text-primary mb-3">{{ $servis->nomor_servis }}</h2>
                        
                        @php
                            $badgeClass = 'bg-masuk';
                            if($servis->status instanceof \App\Enums\ServisStatus) {
                                $badgeClass = $servis->status->badgeClass();
                            }
                            $badgeClass = str_replace('badge-', 'bg-', $badgeClass);
                            
                            $statusIcon = match($servis->status->value ?? 'Masuk') {
                                'Masuk' => 'inbox',
                                'Dicek' => 'magnifying-glass',
                                'Proses' => 'wrench',
                                'Selesai' => 'circle-check',
                                'Diambil' => 'box',
                                default => 'circle'
                            };
                        @endphp
                        
                        <div class="d-flex align-items-center">
                            <span class="badge {{ $badgeClass }} px-3 py-2 me-2" style="font-size: 1rem;">
                                <i class="fa-solid fa-{{ $statusIcon }} me-1"></i>
                                {{ $servis->status instanceof \App\Enums\ServisStatus ? $servis->status->label() : $servis->status }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        @if($servis->status->value === 'Selesai')
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 text-center">
                                <i class="fa-solid fa-check-circle fa-2x mb-2"></i>
                                <div class="fw-semibold">Siap Diambil!</div>
                                <small>Silakan datang ke toko</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Info Utama -->
            <div class="col-lg-7">
                <!-- Detail Perangkat -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-laptop me-2 text-primary"></i>
                        Detail Perangkat
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="text-muted small text-uppercase fw-semibold mb-1">Unit Laptop</div>
                            <div class="fw-semibold fs-5">{{ $servis->type_laptop }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small text-uppercase fw-semibold mb-1">Keluhan / Kerusakan</div>
                            <div class="bg-light p-3 rounded-3">{{ $servis->jenis_kerusakan }}</div>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold mb-2">Kelengkapan</div>
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
                                    <span class="badge bg-secondary">{{ $servis->kelengkapan_lainnya }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-timeline me-2 text-primary"></i>
                        Progress Status
                    </div>
                    <div class="card-body">
                        @php
                            $statuses = ['Masuk', 'Dicek', 'Proses', 'Selesai', 'Diambil'];
                            $currentIndex = array_search($servis->status->value ?? 'Masuk', $statuses);
                        @endphp
                        
                        <div class="d-flex justify-content-between position-relative">
                            <!-- Progress Line -->
                            <div class="position-absolute" style="top: 16px; left: 24px; right: 24px; height: 4px; background: #E2E8F0; z-index: 0;">
                                <div style="width: {{ ($currentIndex / 4) * 100 }}%; height: 100%; background: #3B82F6;"></div>
                            </div>
                            
                            @foreach($statuses as $index => $status)
                                @php
                                    $isCompleted = $index <= $currentIndex;
                                    $isCurrent = $index === $currentIndex;
                                @endphp
                                <div class="text-center position-relative" style="z-index: 1;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2
                                        {{ $isCompleted ? 'bg-primary text-white' : 'bg-light text-muted border' }}"
                                        style="width: 36px; height: 36px; {{ $isCurrent ? 'box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);' : '' }}">
                                        @if($isCompleted && !$isCurrent)
                                            <i class="fa-solid fa-check"></i>
                                        @else
                                            <span class="small fw-semibold">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                    <div class="small {{ $isCurrent ? 'fw-bold text-primary' : ($isCompleted ? 'text-dark' : 'text-muted') }}">
                                        {{ $status }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-5">
                <!-- Info Waktu -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-calendar me-2 text-primary"></i>
                        Informasi Waktu
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="text-muted small text-uppercase fw-semibold mb-1">Tanggal Masuk</div>
                            <div class="fw-semibold">{{ $servis->tanggal_masuk->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold mb-1">Estimasi Selesai</div>
                            <div class="fw-semibold">
                                {{ $servis->tanggal_jadi ? $servis->tanggal_jadi->format('d M Y') : 'Belum ditentukan' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biaya -->
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
                            <span class="text-muted">Sudah Dibayar</span>
                            <span class="badge bg-success">{{ $servis->formatRupiah($servis->panjar) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3">
                            <span class="fw-semibold small">SISA</span>
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
                    <div class="card-body text-center py-4">
                        <div class="text-info mb-2">
                            <i class="fa-solid fa-clock-rotate-left fa-2x"></i>
                        </div>
                        <div class="fs-4 fw-bold text-info">{{ $servis->getGaransiText() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="card mt-4 bg-light border-0">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-1">Ada Pertanyaan?</h5>
                        <p class="text-muted mb-0">Hubungi kami untuk informasi lebih lanjut tentang servis Anda</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaturan->no_kontak) }}?text=Halo, saya ingin menanyakan status servis dengan nomor {{ $servis->nomor_servis }}" 
                           class="btn btn-success" target="_blank">
                            <i class="fa-brands fa-whatsapp me-2"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
