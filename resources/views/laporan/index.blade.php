@extends('layouts.app')

@section('title', 'Laporan Servis')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 d-print-none">
    <div>
        <h1 class="page-title">Laporan Servis</h1>
        <p class="page-subtitle">Rekapitulasi data dan pendapatan servis</p>
    </div>
    <div class="mt-3 mt-md-0">
        <button onclick="window.print()" class="btn btn-dark">
            <i class="fa-solid fa-print"></i> Cetak Laporan
        </button>
    </div>
</div>

<!-- Print Header -->
<div class="d-none d-print-block mb-4 text-center">
    <h2 class="fw-bold mb-1">LAPORAN SERVIS DEFKAN COMPUTER</h2>
    <p class="mb-0">Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d/m/Y') }}</p>
    <hr>
</div>

<!-- Filter -->
<div class="card mb-4 d-print-none">
    <div class="card-body py-3">
        <form action="{{ route('laporan') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-filter me-2"></i> Tampilkan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Summary Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="text-muted small text-uppercase mb-1">Total Unit</div>
                <h3 class="fw-bold mb-0">{{ $totalServis }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-start border-4 border-warning">
            <div class="card-body text-center">
                <div class="text-muted small text-uppercase mb-1">Dikerjakan</div>
                <h3 class="fw-bold mb-0 text-warning">{{ $servisProses }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-start border-4 border-success">
            <div class="card-body text-center">
                <div class="text-muted small text-uppercase mb-1">Selesai</div>
                <h3 class="fw-bold mb-0 text-success">{{ $servisSelesai }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card h-100 border-start border-4 border-info">
            <div class="card-body text-center">
                <div class="text-muted small text-uppercase mb-1">Diambil</div>
                <h3 class="fw-bold mb-0 text-info">{{ $servisDiambil }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 bg-success text-white">
            <div class="card-body py-4">
                <div class="small text-uppercase opacity-75 fw-semibold mb-1">
                    <i class="fa-solid fa-arrow-down me-1"></i> Total Panjar Masuk
                </div>
                <h2 class="fw-bold mb-0">Rp {{ number_format($totalPanjar, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 bg-primary text-white">
            <div class="card-body py-4">
                <div class="small text-uppercase opacity-75 fw-semibold mb-1">
                    <i class="fa-solid fa-chart-line me-1"></i> Total Nilai Servis (Diambil)
                </div>
                <h2 class="fw-bold mb-0">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-table me-2 text-muted"></i>
        Rincian Data Periode
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No. Servis</th>
                        <th>Konsumen</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Panjar</th>
                        <th class="text-end pe-4">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servis as $item)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-semibold">{{ $item->nomor_servis }}</span>
                        </td>
                        <td>{{ $item->nama_konsumen }}</td>
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
                        <td>
                            <span class="text-success">Rp {{ number_format($item->panjar, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-end pe-4 fw-semibold">
                            Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-inbox"></i>
                                <p>Tidak ada data untuk periode ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($servis->count() > 0)
                <tfoot class="table-dark">
                    <tr>
                        <td colspan="4" class="ps-4 fw-bold">TOTAL REKAPITULASI</td>
                        <td class="fw-bold text-success">Rp {{ number_format($totalPanjar, 0, ',', '.') }}</td>
                        <td class="text-end pe-4 fw-bold fs-5">Rp {{ number_format($servis->sum('total_biaya'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
