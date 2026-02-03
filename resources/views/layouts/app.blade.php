<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Manajemen Servis Laptop - Defkan Computer">
    <title>@yield('title', 'Defkan Computer') - Sistem Servis</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <!-- Sidebar Desktop -->
    <div class="sidebar d-none d-lg-flex">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Defkan">
            <h1>Defkan Computer</h1>
        </div>
        
        <nav class="nav-menu">
            <div class="nav-section-title">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
            
            <div class="nav-section-title">Manajemen Servis</div>
            <a href="{{ route('servis.create') }}" class="nav-link {{ request()->routeIs('servis.create') ? 'active' : '' }}">
                <i class="fa-solid fa-plus"></i> Input Servis
            </a>
            <a href="{{ route('servis.index') }}" class="nav-link {{ request()->routeIs('servis.index') || request()->routeIs('servis.show') || request()->routeIs('servis.edit') ? 'active' : '' }}">
                <i class="fa-solid fa-laptop-medical"></i> Data Servis
            </a>
            
            <div class="nav-section-title">Laporan & Sistem</div>
            <a href="{{ route('laporan') }}" class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Laporan
            </a>
            <a href="{{ route('tracking.logs') }}" class="nav-link {{ request()->routeIs('tracking.logs') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left"></i> Log Tracking
            </a>
            <a href="{{ route('pengaturan') }}" class="nav-link {{ request()->routeIs('pengaturan') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Pengaturan
            </a>
        </nav>

        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout bg-transparent border-0 w-100 text-start">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="d-lg-none mobile-nav">
        <h5><i class="fa-solid fa-laptop-medical me-2"></i>Defkan Computer</h5>
        <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <div class="collapse d-lg-none" id="mobileMenu">
        <div class="mobile-menu">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard</a>
            <a href="{{ route('servis.create') }}"><i class="fa-solid fa-plus me-2"></i>Input Servis</a>
            <a href="{{ route('servis.index') }}"><i class="fa-solid fa-laptop-medical me-2"></i>Data Servis</a>
            <a href="{{ route('laporan') }}"><i class="fa-solid fa-chart-line me-2"></i>Laporan</a>
            <a href="{{ route('tracking.logs') }}"><i class="fa-solid fa-clock-rotate-left me-2"></i>Log Tracking</a>
            <a href="{{ route('pengaturan') }}"><i class="fa-solid fa-gear me-2"></i>Pengaturan</a>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm w-100">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid px-0">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-2"></i>
                        <div>{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
