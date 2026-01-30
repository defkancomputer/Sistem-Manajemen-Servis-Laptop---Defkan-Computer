<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cek status servis laptop Anda - Defkan Computer">
    <title>@yield('title', 'Cek Status Servis') - {{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</title>
    
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
    
    <style>
        body {
            background: var(--bg-main);
        }
        
        .public-header {
            background: var(--sidebar-bg);
            color: white;
            padding: 1rem 0;
        }
        
        .public-header .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .public-header .brand img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: white;
            padding: 2px;
        }
        
        .public-header .brand-name {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .public-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .public-nav .nav-link {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .public-nav .nav-link:hover,
        .public-nav .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        
        .public-main {
            min-height: calc(100vh - 140px);
            padding: 2rem 0;
        }
        
        .public-footer {
            background: var(--sidebar-bg);
            padding: 1.5rem 0;
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
        }
        
        .public-footer a {
            color: white;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .public-nav {
                display: none;
            }
            .mobile-menu-btn {
                display: block !important;
            }
        }
        
        .mobile-menu-btn {
            display: none;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="public-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('home') }}" class="brand text-decoration-none text-white">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    <span class="brand-name">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</span>
                </a>
                
                <nav class="public-nav">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fa-solid fa-home me-1"></i> Beranda
                    </a>
                    <a href="{{ route('tracking.index') }}" class="nav-link {{ request()->routeIs('tracking.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Cek Servis
                    </a>
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="fa-solid fa-user me-1"></i> Admin
                    </a>
                </nav>
                
                <button class="btn btn-sm btn-outline-light mobile-menu-btn d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            
            <!-- Mobile Nav -->
            <div class="collapse mt-3 d-md-none" id="mobileNav">
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-home me-1"></i> Beranda
                    </a>
                    <a href="{{ route('tracking.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Cek Servis
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-user me-1"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="public-main">
        <div class="container">
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

    <!-- Footer -->
    <footer class="public-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="fw-semibold text-white mb-1">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</div>
                    <div><i class="fa-solid fa-location-dot me-2"></i>{{ $pengaturan->alamat ?? '' }}</div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaturan->no_kontak ?? '') }}" target="_blank">
                        <i class="fa-brands fa-whatsapp me-1"></i> {{ $pengaturan->no_kontak ?? '' }}
                    </a>
                    <div class="mt-2 small opacity-75">&copy; {{ date('Y') }} All rights reserved.</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
