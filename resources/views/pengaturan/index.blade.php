@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<!-- Page Header -->
<div class="mb-4">
    <h1 class="page-title">Pengaturan</h1>
    <p class="page-subtitle">Sesuaikan informasi toko dan profil sistem</p>
</div>

<form action="{{ route('pengaturan.update') }}" method="POST">
    @csrf
    
    <div class="row g-4">
        <!-- Main Settings -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-store me-2 text-primary"></i>
                    Profil Toko
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Toko <span class="text-danger">*</span></label>
                        <input type="text" name="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" 
                               value="{{ old('nama_toko', $pengaturan->nama_toko) }}" required>
                        @error('nama_toko')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                  rows="3" placeholder="Alamat lengkap toko...">{{ old('alamat', $pengaturan->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nomor Kontak / WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-brands fa-whatsapp text-success"></i></span>
                            <input type="text" name="no_kontak" class="form-control @error('no_kontak') is-invalid @enderror" 
                                   value="{{ old('no_kontak', $pengaturan->no_kontak) }}" placeholder="08xxxxxxxxxx">
                        </div>
                        @error('no_kontak')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">Ketentuan Servis</label>
                        <textarea name="ketentuan_servis" class="form-control @error('ketentuan_servis') is-invalid @enderror" 
                                  rows="6" placeholder="Satu baris per ketentuan...">{{ old('ketentuan_servis', $pengaturan->ketentuan_servis) }}</textarea>
                        <div class="form-text">
                            <i class="fa-solid fa-circle-info text-info me-1"></i>
                            Satu baris akan menjadi satu poin di nota cetak
                        </div>
                        @error('ketentuan_servis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Help Card -->
            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <h6 class="fw-semibold mb-2">
                        <i class="fa-solid fa-circle-question me-2 text-primary"></i>
                        Bantuan
                    </h6>
                    <p class="small text-muted mb-0">
                        Informasi di halaman ini akan langsung muncul pada header dan footer nota cetak. 
                        Pastikan alamat dan nomor kontak aktif agar pelanggan mudah menghubungi.
                    </p>
                </div>
            </div>
            
            <!-- Admin Info -->
            @if(auth()->user())
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-user-shield me-2 text-primary"></i>
                    Akun Admin
                </div>
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-user fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-1">{{ auth()->user()->username }}</h5>
                    <span class="badge bg-primary">{{ strtoupper(auth()->user()->role) }}</span>
                    <hr>
                    <p class="small text-muted mb-0">
                        Sistem ini memiliki satu akses admin utama untuk keamanan data.
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</form>
@endsection
