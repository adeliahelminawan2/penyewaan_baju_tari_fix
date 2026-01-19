<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Busana Laras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #2B2118;
            --accent-gold: #B37428;
            --soft-bg: #f4f1ee;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .sidebar {
            width: 280px;
            background-color: var(--primary-dark);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 2.5rem 1.5rem;
            color: white;
            display: flex;
            flex-direction: column;
            border-right: 4px solid var(--accent-gold);
        }

        .main-wrapper {
            margin-left: 280px;
            padding: 3rem;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 3rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 2rem;
            border: 1px solid rgba(179, 116, 40, 0.2);
        }

        .logo-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 20px;
            border: 2px solid var(--accent-gold);
            margin: 0 auto 1rem;
            display: block;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 1.1rem 1.3rem;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 1rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--accent-gold);
            color: white;
            box-shadow: 0 10px 20px rgba(179, 116, 40, 0.2);
        }

        .logout-container {
            margin-top: auto;
            padding-top: 2rem;
        }

        .btn-logout {
            width: 100%;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(248, 113, 113, 0.2);
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="logo-section">
            <img src="{{ asset('img/LOGO.jpg') }}" alt="Logo Busana Laras" class="logo-img">
            <h2 class="text-[#B37428] font-black tracking-[3px] text-sm uppercase">Busana Laras</h2>
            <p class="text-[10px] opacity-50 tracking-[2px] uppercase mt-1">Management System</p>
        </div>

        <nav>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <a href="{{ route('admin.laporan.index') }}"
                class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan
            </a>
            <a href="{{ route('admin.baju.index') }}"
                class="nav-link {{ request()->routeIs('admin.baju.*') ? 'active' : '' }}">
                <i class="fas fa-tshirt"></i> Stok Busana
            </a>
            <a href="{{ route('admin.penyewaan.index') }}"
                class="nav-link {{ request()->routeIs('admin.penyewaan.*') ? 'active' : '' }}">
                <i class="fas fa-retweet"></i> Transaksi Sewa
            </a>
        </nav>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-power-off"></i> KELUAR SISTEM
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-black text-[#2B2118] uppercase tracking-tight">
                Panel Kontrol <span class="text-[#B37428]">Admin</span>
            </h1>
            <div
                class="text-xs font-bold text-gray-400 uppercase tracking-widest bg-white px-4 py-2 rounded-full shadow-sm">
                {{ date('d F Y') }}
            </div>
        </div>

        @yield('content')
    </main>

</body>

</html>
