<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Busana Laras</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-dark: #2B2118;
            --accent-gold: #B37428;
            --bg-soft: #f8f9fa;
            --sidebar-width: 280px;
        }

        body {
            background-color: var(--bg-soft);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--primary-dark);
            margin: 0;
        }

        .fw-black { font-weight: 900; }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--primary-dark);
            color: white;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 0 30px rgba(0,0,0,0.1);
        }

        .logo-section {
            padding: 2.5rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            text-align: center;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
            border: 3px solid var(--accent-gold);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .nav-link-custom {
            padding: 1rem 2rem;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .nav-link-custom i {
            font-size: 1.1rem;
            width: 20px;
        }

        .nav-link-custom:hover {
            color: white;
            background: rgba(255,255,255,0.03);
            border-left-color: var(--accent-gold);
        }

        .nav-link-custom.active {
            color: white;
            background: rgba(179, 116, 40, 0.1);
            border-left-color: var(--accent-gold);
        }

        .logout-container {
            margin-top: auto;
            padding: 2rem;
        }

        .btn-logout {
            width: 100%;
            padding: 0.8rem;
            background: rgba(255,255,255,0.05);
            color: white;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.75rem;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: #dc3545;
            transform: translateY(-2px);
        }

        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 2.5rem;
            min-height: 100vh;
        }

        .tracking-tight-custom {
            letter-spacing: -1px;
        }

        .text-accent-gold {
            color: var(--accent-gold) !important;
        }

        .bg-primary-dark {
            background-color: var(--primary-dark) !important;
        }

        .rounded-5 { border-radius: 2rem !important; }
        .rounded-4 { border-radius: 1.5rem !important; }

        .card {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.2; }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <aside class="sidebar">
        <div class="logo-section">
            <img src="{{ asset('img/LOGO.jpg') }}" alt="Logo Busana Laras" class="logo-img">
            <h2 class="text-accent-gold fw-black text-uppercase shadow-sm mb-1" style="font-size: 0.85rem; letter-spacing: 3px;">Busana Laras</h2>
            <p class="text-uppercase opacity-50 mb-0" style="font-size: 10px; letter-spacing: 2px;">Sistem Manajemen</p>
        </div>

        <nav>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> Beranda
            </a>
            <a href="{{ route('admin.laporan.index') }}"
                class="nav-link-custom {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan
            </a>
            <a href="{{ route('admin.baju.index') }}"
                class="nav-link-custom {{ request()->routeIs('admin.baju.*') ? 'active' : '' }}">
                <i class="fas fa-tshirt"></i> Stok Busana
            </a>
            <a href="{{ route('admin.penyewaan.index') }}"
                class="nav-link-custom {{ request()->routeIs('admin.penyewaan.*') ? 'active' : '' }}">
                <i class="fas fa-retweet"></i> Transaksi Sewa
            </a>
        </nav>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout border-0">
                    <i class="fas fa-power-off"></i> KELUAR SISTEM
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1 class="h3 fw-black text-dark text-uppercase tracking-tight-custom">
                Panel Kontrol <span class="text-accent-gold">Admin</span>
            </h1>
            <div class="badge bg-white text-muted text-uppercase fw-bold rounded-pill shadow-sm px-4 py-2" style="font-size: 10px; letter-spacing: 1px;">
                {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
            </div>
        </div>

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>

</html>
