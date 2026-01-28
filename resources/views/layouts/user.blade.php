<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cek status servis laptop Anda - Defkan Computer">
    <title>@yield('title', 'Defkan Computer') - Spesialis Servis Laptop</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #3B82F6;
            --primary-hover: #2563EB;
            --text-primary: #1E293B;
            --text-muted: #64748B;
            --bg-main: #F8FAFC;
            --bg-card: #FFFFFF;
            --border-color: #E2E8F0;
            --header-bg: #1E293B;
        }
        
        * { box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-main);
            color: var(--text-primary);
            margin: 0;
        }
        
        /* ========== HEADER ========== */
        .user-header {
            background: var(--header-bg);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .user-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }
        
        .brand img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }
        
        .brand-name {
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .user-nav {
            display: flex;
            gap: 0.25rem;
        }
        
        .user-nav a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .user-nav a:hover,
        .user-nav a.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        
        .mobile-toggle {
            display: none;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .user-nav { display: none; }
            .mobile-toggle { display: block; }
            .user-nav.show {
                display: flex;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--header-bg);
                padding: 1rem;
                gap: 0.5rem;
            }
        }
        
        /* ========== MAIN ========== */
        .user-main {
            min-height: calc(100vh - 160px);
            padding: 2rem 0;
        }
        
        /* ========== FOOTER ========== */
        .user-footer {
            background: var(--header-bg);
            color: rgba(255,255,255,0.7);
            padding: 2rem 0;
        }
        
        .user-footer a {
            color: white;
            text-decoration: none;
        }
        
        .user-footer a:hover {
            text-decoration: underline;
        }
        
        /* ========== COMPONENTS ========== */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 1rem 1.25rem;
        }
        
        .card-body { padding: 1.25rem; }
        
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .alert {
            border: none;
            border-radius: 8px;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Header (Customer Only - No Admin Links) -->
    <header class="user-header">
        <div class="container position-relative">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
                <span class="brand-name">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</span>
            </a>
            
            <button class="mobile-toggle" onclick="document.querySelector('.user-nav').classList.toggle('show')">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <nav class="user-nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fa-solid fa-home me-1"></i> Beranda
                </a>
                <a href="{{ route('tracking.index') }}" class="{{ request()->routeIs('tracking.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Cek Servis
                </a>
                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaturan->no_kontak ?? '') }}" target="_blank">
                    <i class="fa-brands fa-whatsapp me-1"></i> Kontak
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="user-main">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <!-- Footer (Customer - No Admin Links) -->
    <footer class="user-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold text-white mb-2">{{ $pengaturan->nama_toko ?? 'Defkan Computer' }}</h5>
                    <p class="mb-1">
                        <i class="fa-solid fa-location-dot me-2"></i>{{ $pengaturan->alamat ?? '' }}
                    </p>
                    <p class="mb-0">
                        <i class="fa-brands fa-whatsapp me-2"></i>
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengaturan->no_kontak ?? '') }}" target="_blank">
                            {{ $pengaturan->no_kontak ?? '' }}
                        </a>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="text-white mb-2">Menu</h6>
                    <a href="{{ route('home') }}" class="d-block mb-1">Beranda</a>
                    <a href="{{ route('tracking.index') }}" class="d-block mb-1">Cek Status Servis</a>
                </div>
            </div>
            <hr class="my-3 border-secondary">
            <p class="text-center mb-0 small opacity-75">
                &copy; {{ date('Y') }} {{ $pengaturan->nama_toko ?? 'Defkan Computer' }}. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
