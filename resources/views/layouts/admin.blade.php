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
