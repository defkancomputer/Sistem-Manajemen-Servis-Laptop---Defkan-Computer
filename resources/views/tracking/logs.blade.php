@extends('layouts.app')

@section('title', 'Log Tracking')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h1 class="page-title">Log Tracking Pengunjung</h1>
        <p class="page-subtitle">Riwayat pengecekan status servis oleh customer</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-2">Hari Ini</div>
                        <div class="stat-value">{{ $totalToday }}</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100" style="border-left-color: #10B981;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label mb-2">Total Semua</div>
                        <div class="stat-value">{{ $totalAll }}</div>
                    </div>
                    <div class="icon-box" style="background: #ECFDF5; color: #10B981;">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('tracking.logs') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-semibold text-muted">Cari</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               placeholder="Nomor servis atau nama customer..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted">Filter Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="fa-solid fa-filter me-1"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-clock-rotate-left me-2 text-muted"></i>
        Log Pengecekan Status Servis
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nomor Servis</th>
                        <th>Nama Customer</th>
                        <th>Waktu Cek</th>
                        <th>Device</th>
                        <th>IP Address</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-semibold text-primary">{{ $log->nomor_servis }}</span>
                        </td>
                        <td>
                            @if($log->servis)
                                <div class="fw-semibold">{{ $log->servis->nama_konsumen }}</div>
                                <small class="text-muted">
                                    <i class="fa-brands fa-whatsapp text-success"></i> {{ $log->servis->no_hp }}
                                </small>
                            @else
                                <span class="text-muted">Data dihapus</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $log->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">
                                @if($log->getDeviceType() == 'Mobile')
                                    <i class="fa-solid fa-mobile-screen-button me-1"></i>
                                @elseif($log->getDeviceType() == 'Tablet')
                                    <i class="fa-solid fa-tablet-screen-button me-1"></i>
                                @else
                                    <i class="fa-solid fa-desktop me-1"></i>
                                @endif
                                {{ $log->getDeviceType() }}
                            </span>
                        </td>
                        <td>
                            <code class="small">{{ $log->ip_address ?? '-' }}</code>
                        </td>
                        <td class="text-end pe-4">
                            @if($log->servis)
                            <a href="{{ route('servis.show', $log->servis->id) }}" class="btn btn-sm btn-light" title="Lihat Detail Servis">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <p>Belum ada log pengecekan servis</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($logs->hasPages())
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted small">
        Menampilkan {{ $logs->firstItem() }} - {{ $logs->lastItem() }} dari {{ $logs->total() }} log
    </div>
    <div>
        {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endif
@endsection
