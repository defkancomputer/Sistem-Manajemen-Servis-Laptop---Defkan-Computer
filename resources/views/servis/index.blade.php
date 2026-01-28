@extends('layouts.app')

@section('title', 'Data Servis')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h1 class="page-title">Data Servis</h1>
        <p class="page-subtitle">Kelola semua data servis laptop pelanggan</p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="{{ route('servis.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Input Servis Baru
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('servis.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-6 col-lg-7">
                    <label class="form-label small fw-semibold text-muted">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               placeholder="Cari nomor servis, nama pelanggan, atau tipe laptop..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <label class="form-label small fw-semibold text-muted">Filter Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach(\App\Enums\ServisStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="fa-solid fa-search me-1"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No. Servis</th>
                        <th>Pelanggan</th>
                        <th>Unit Laptop</th>
                        <th>Kerusakan</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servis as $item)
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
                        <td>
                            <span class="fw-medium">{{ $item->type_laptop }}</span>
                        </td>
                        <td>
                            <span class="text-muted" title="{{ $item->jenis_kerusakan }}">
                                {{ Str::limit($item->jenis_kerusakan, 30) }}
                            </span>
                        </td>
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
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Opsi
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('servis.show', $item->id) }}">
                                            <i class="fa-solid fa-eye me-2 text-primary"></i> Lihat Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('servis.edit', $item->id) }}">
                                            <i class="fa-solid fa-pen me-2 text-warning"></i> Edit Data
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('servis.print', $item->id) }}" target="_blank">
                                            <i class="fa-solid fa-print me-2 text-info"></i> Cetak Nota
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('servis.destroy', $item->id) }}" method="POST" 
                                              onsubmit="return confirm('Yakin ingin menghapus data servis ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fa-solid fa-trash me-2"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fa-solid fa-folder-open"></i>
                                <p>Tidak ada data servis yang ditemukan</p>
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
@if($servis->hasPages())
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted small">
        Menampilkan {{ $servis->firstItem() }} - {{ $servis->lastItem() }} dari {{ $servis->total() }} data
    </div>
    <div>
        {{ $servis->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endif
@endsection
