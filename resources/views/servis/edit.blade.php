@extends('layouts.app')

@section('title', 'Edit Servis')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h1 class="page-title">Edit Data Servis</h1>
        <p class="page-subtitle">Memperbarui data servis <span class="fw-semibold text-primary">{{ $servis->nomor_servis }}</span></p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="{{ route('servis.show', $servis->id) }}" class="btn btn-light">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Detail
        </a>
    </div>
</div>

<form action="{{ route('servis.update', $servis->id) }}" method="POST" id="formServis">
    @csrf
    @method('PUT')
    
    <!-- Hidden fields for actual values -->
    <input type="hidden" name="total_biaya" id="total_biaya_real" value="{{ old('total_biaya', $servis->total_biaya) }}">
    <input type="hidden" name="panjar" id="panjar_real" value="{{ old('panjar', $servis->panjar) }}">
    
    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Data Pelanggan -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-user me-2 text-primary"></i>
                    Data Pelanggan
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_konsumen" class="form-control @error('nama_konsumen') is-invalid @enderror" 
                                   value="{{ old('nama_konsumen', $servis->nama_konsumen) }}" required>
                            @error('nama_konsumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-brands fa-whatsapp text-success"></i></span>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                       value="{{ old('no_hp', $servis->no_hp) }}" required>
                            </div>
                            @error('no_hp')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="text" name="tanggal_masuk" class="form-control datepicker" 
                                   value="{{ old('tanggal_masuk', $servis->tanggal_masuk->format('d/m/Y')) }}" required placeholder="DD/MM/YYYY">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estimasi Selesai</label>
                            <input type="text" name="tanggal_jadi" class="form-control datepicker" 
                                   value="{{ old('tanggal_jadi', $servis->tanggal_jadi?->format('d/m/Y')) }}" placeholder="DD/MM/YYYY">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Perangkat -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-laptop me-2 text-primary"></i>
                    Detail Perangkat & Kerusakan
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tipe / Merk Laptop <span class="text-danger">*</span></label>
                        <input type="text" name="type_laptop" class="form-control" 
                               value="{{ old('type_laptop', $servis->type_laptop) }}" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Keluhan / Kerusakan <span class="text-danger">*</span></label>
                        <textarea name="jenis_kerusakan" class="form-control" rows="4" required>{{ old('jenis_kerusakan', $servis->jenis_kerusakan) }}</textarea>
                    </div>
                    
                    <div>
                        <label class="form-label">Kelengkapan Perangkat</label>
                        <div class="bg-light p-3 rounded-3 border">
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kelengkapan_laptop" 
                                               id="kel_laptop" value="1" {{ old('kelengkapan_laptop', $servis->kelengkapan_laptop) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kel_laptop">
                                            <i class="fa-solid fa-laptop text-muted me-1"></i> Laptop
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kelengkapan_charger" 
                                               id="kel_charger" value="1" {{ old('kelengkapan_charger', $servis->kelengkapan_charger) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kel_charger">
                                            <i class="fa-solid fa-plug text-muted me-1"></i> Charger
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kelengkapan_baterai" 
                                               id="kel_baterai" value="1" {{ old('kelengkapan_baterai', $servis->kelengkapan_baterai) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kel_baterai">
                                            <i class="fa-solid fa-battery-full text-muted me-1"></i> Baterai
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kelengkapan_tas" 
                                               id="kel_tas" value="1" {{ old('kelengkapan_tas', $servis->kelengkapan_tas) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kel_tas">
                                            <i class="fa-solid fa-briefcase text-muted me-1"></i> Tas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="kelengkapan_lainnya" class="form-control form-control-sm mt-2" 
                                           placeholder="Kelengkapan lainnya" value="{{ old('kelengkapan_lainnya', $servis->kelengkapan_lainnya) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Update Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-wrench me-2 text-primary"></i>
                    Update Status
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Teknisi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_teknisi" class="form-control" 
                               value="{{ old('nama_teknisi', $servis->nama_teknisi) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Saat Ini <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            @foreach(\App\Enums\ServisStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('status', $servis->status->value) == $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Catatan Teknisi</label>
                        <textarea name="catatan_teknisi" class="form-control" rows="2">{{ old('catatan_teknisi', $servis->catatan_teknisi) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Biaya & Garansi -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-money-bill-wave me-2 text-primary"></i>
                    Biaya & Garansi
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Total Biaya</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" id="total_biaya_display" class="form-control fw-semibold currency-input" 
                                   value="{{ number_format(old('total_biaya', $servis->total_biaya), 0, ',', '.') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uang Muka (Panjar)</label>
                        <div class="input-group">
                            <span class="input-group-text text-success">Rp</span>
                            <input type="text" id="panjar_display" class="form-control currency-input" 
                                   value="{{ number_format(old('panjar', $servis->panjar), 0, ',', '.') }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col-8">
                            <label class="form-label">Masa Garansi</label>
                            <input type="number" name="garansi_nilai" class="form-control" 
                                   value="{{ old('garansi_nilai', $servis->garansi_nilai) }}" min="0">
                        </div>
                        <div class="col-4">
                            <label class="form-label">Satuan</label>
                            <select name="garansi_satuan" class="form-select">
                                <option value="Hari" {{ old('garansi_satuan', $servis->garansi_satuan) == 'Hari' ? 'selected' : '' }}>Hari</option>
                                <option value="Bulan" {{ old('garansi_satuan', $servis->garansi_satuan) == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="card border-0 bg-primary text-white">
                <div class="card-body">
                    <button type="submit" class="btn btn-light btn-lg w-100 fw-semibold text-primary mb-2">
                        <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('servis.show', $servis->id) }}" class="btn btn-link text-white-50 w-100 text-decoration-none">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
// Format currency with dots (1000 -> 1.000)
function formatCurrency(input) {
    let value = input.value.replace(/\D/g, '');
    if (value === '') value = '0';
    input.value = parseInt(value).toLocaleString('id-ID');
    return parseInt(value);
}

// Currency inputs
document.querySelectorAll('.currency-input').forEach(function(input) {
    input.addEventListener('input', function() {
        const realValue = formatCurrency(this);
        if (this.id === 'total_biaya_display') {
            document.getElementById('total_biaya_real').value = realValue;
        } else if (this.id === 'panjar_display') {
            document.getElementById('panjar_real').value = realValue;
        }
    });
    
    // Initialize on load
    formatCurrency(input);
});

// Date format DD/MM/YYYY
document.querySelectorAll('.datepicker').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 8) value = value.slice(0, 8);
        
        let formatted = '';
        if (value.length > 0) {
            formatted = value.slice(0, 2);
            if (value.length > 2) formatted += '/' + value.slice(2, 4);
            if (value.length > 4) formatted += '/' + value.slice(4, 8);
        }
        this.value = formatted;
    });
});
</script>
@endsection
