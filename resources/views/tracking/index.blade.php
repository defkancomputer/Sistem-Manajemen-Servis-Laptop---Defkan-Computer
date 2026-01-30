@extends('layouts.user')

@section('title', 'Cek Status Servis')

@section('styles')
<style>
    /* Full viewport height for status check - UX focused */
    .status-check-wrapper {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 0;
    }
    
    .status-check-container {
        width: 100%;
        max-width: 420px;
    }
    
    /* Icon styling */
    .status-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    /* Title styling */
    .status-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.5rem;
    }
    
    .status-subtitle {
        font-size: 0.9rem;
        color: #64748B;
        margin-bottom: 1.5rem;
    }
    
    /* Form card */
    .status-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    /* Input styling */
    .status-input {
        font-size: 1.1rem;
        padding: 0.875rem 1rem;
        border-radius: 10px;
        border: 2px solid #E2E8F0;
        text-align: center;
        letter-spacing: 1px;
        font-weight: 500;
    }
    
    .status-input:focus {
        border-color: #3B82F6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        outline: none;
    }
    
    .status-input::placeholder {
        font-size: 0.85rem;
        letter-spacing: 0;
        font-weight: 400;
    }
    
    /* Button */
    .status-btn {
        font-size: 1rem;
        font-weight: 600;
        padding: 0.875rem 1.5rem;
        border-radius: 10px;
        width: 100%;
    }
    
    /* Info badges */
    .info-badges {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .info-badge {
        text-align: center;
    }
    
    .info-badge i {
        font-size: 1.25rem;
        color: #3B82F6;
        margin-bottom: 0.25rem;
    }
    
    .info-badge span {
        display: block;
        font-size: 0.7rem;
        color: #64748B;
    }
    
    /* Responsive */
    @media (min-width: 768px) {
        .status-icon {
            width: 80px;
            height: 80px;
        }
        .status-title {
            font-size: 1.75rem;
        }
        .status-subtitle {
            font-size: 1rem;
        }
        .status-card {
            padding: 2rem;
        }
        .status-input {
            font-size: 1.25rem;
            padding: 1rem 1.25rem;
        }
        .info-badge i {
            font-size: 1.5rem;
        }
        .info-badge span {
            font-size: 0.75rem;
        }
    }
</style>
@endsection

@section('content')
<div class="status-check-wrapper">
    <div class="status-check-container">
        <!-- Header -->
        <div class="text-center">
            <div class="status-icon bg-primary bg-opacity-10">
                <i class="fa-solid fa-magnifying-glass fa-xl text-primary"></i>
            </div>
            <h1 class="status-title">Cek Status Servis</h1>
            <p class="status-subtitle">Masukkan nomor servis untuk melihat progress perbaikan</p>
        </div>

        <!-- Search Card -->
        <div class="status-card">
            <form action="{{ route('tracking.show') }}" method="GET">
                <div class="mb-3">
                    <input type="text" name="nomor" class="form-control status-input" 
                           placeholder="Contoh: SRV202601270001" 
                           value="{{ old('nomor') }}" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary status-btn">
                    <i class="fa-solid fa-search me-2"></i> Cek Status
                </button>
            </form>
            
            <div class="text-center mt-3">
                <small class="text-muted">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Nomor servis ada di nota yang Anda terima
                </small>
            </div>
        </div>

        <!-- Info Badges -->
        <div class="info-badges">
            <div class="info-badge">
                <i class="fa-solid fa-clock"></i>
                <span>Real-time</span>
            </div>
            <div class="info-badge">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Aman</span>
            </div>
            <div class="info-badge">
                <i class="fa-brands fa-whatsapp"></i>
                <span>Notifikasi</span>
            </div>
        </div>
    </div>
</div>
@endsection
