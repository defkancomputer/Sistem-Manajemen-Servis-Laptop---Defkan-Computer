@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Selamat datang di Sistem Manajemen Servis Defkan Computer</p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="{{ route('servis.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Input Servis Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <!-- Servis Hari Ini -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-2">Servis Hari Ini</div>
                        <div class="stat-value">{{ $totalHariIni }}</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Dalam Proses -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100" style="border-left-color: #F59E0B;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-2">Dalam Proses</div>
                        <div class="stat-value">{{ $servisProses }}</div>
                    </div>
                    <div class="icon-box" style="background: #FFFBEB; color: #F59E0B;">
                        <i class="fa-solid fa-wrench"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Selesai -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100" style="border-left-color: #10B981;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-2">Siap Diambil</div>
                        <div class="stat-value">{{ $servisSelesai }}</div>
                    </div>
                    <div class="icon-box" style="background: #ECFDF5; color: #10B981;">
                        <i class="fa-solid fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Belum Diambil -->
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100" style="border-left-color: #6366F1;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-2">Belum Diambil</div>
                        <div class="stat-value">{{ $belumDiambil }}</div>
                    </div>
                    <div class="icon-box" style="background: #EEF2FF; color: #6366F1;">
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Services -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fa-solid fa-clock-rotate-left me-2 text-muted"></i>Servis Terbaru</span>
        <a href="{{ route('servis.index') }}" class="btn btn-sm btn-light">
            Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No. Servis</th>
                        <th>Pelanggan</th>
                        <th>Unit Laptop</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servisTerbaru as $item)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-semibold text-primary">{{ $item->nomor_servis }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $item->nama_konsumen }}</div>
                            <small class="text-muted">
                                <i class="fa-brands fa-whatsapp text-success"></i> {{ $item->no_hp }}
                            </small>
                        </td>
                        <td>{{ $item->type_laptop }}</td>
                        <td>
                            @php
                                $badgeClass = 'bg-masuk';
                                if($item->status instanceof \App\Enums\ServisStatus) {
                                    $badgeClass = $item->status->badgeClass();
                                }
                                $badgeClass = str_replace('badge-', 'bg-', $badgeClass);
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $item->status instanceof \App\Enums\ServisStatus ? $item->status->label() : $item->status }}
                            </span>
                        </td>
                        <td>{{ $item->tanggal_masuk->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('servis.show', $item->id) }}" class="btn btn-sm btn-light">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <p>Belum ada data servis terbaru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
