<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Busana Laras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

        :root {
            --primary-dark: #2B2118;
            --accent-gold: #B37428;
            --bg-login: #3D2B1F;
            --card-cream: #E2D1C3;
        }

        body {
            background-color: var(--bg-login);
            /* Pola bintik emas yang lebih tegas agar senada dengan background login */
            background-image: radial-gradient(var(--accent-gold) 1.5px, transparent 1.5px);
            background-size: 30px 30px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            color: white;
        }

        /* Header Memanjang & Lebih Berisi */
        .main-header {
            background-color: var(--primary-dark);
            padding: 1.5rem 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 5px solid var(--accent-gold);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        /* Logo Diperbesar agar lebih "berasa" */
        .logo-header {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 20px;
            border: 3px solid var(--accent-gold);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }

        .brand-text h1 {
            color: var(--accent-gold);
            margin: 0;
            font-family: 'Playfair Display', serif;
            /* Font klasik agar lebih mewah */
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .brand-text p {
            color: #fff;
            margin: 5px 0 0 0;
            font-size: 0.9rem;
            font-style: italic;
            opacity: 0.7;
            letter-spacing: 2px;
        }

        /* Card Katalog yang lebih kokoh */
        .baju-card {
            background: var(--card-cream);
            border-radius: 2.5rem;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(179, 116, 40, 0.4);
        }

        .baju-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: var(--accent-gold);
        }

        .image-container {
            position: relative;
            height: 420px;
            overflow: hidden;
        }

        .image-container img {
            transition: transform 0.8s ease;
        }

        .baju-card:hover .image-container img {
            transform: scale(1.1);
        }

        .stok-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--primary-dark);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 800;
            border: 2px solid var(--accent-gold);
            z-index: 10;
        }

        .info-content {
            padding: 2.5rem 2rem;
            text-align: center;
            color: var(--primary-dark);
        }

        .info-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .price-text {
            color: var(--accent-gold);
            font-weight: 800;
            font-size: 2rem;
            margin-top: 0.5rem;
        }

        .divider {
            height: 2px;
            width: 50px;
            background: var(--accent-gold);
            margin: 15px auto;
            border-radius: 2px;
        }

        .btn-login-nav {
            background: var(--accent-gold);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            border: 2px solid var(--accent-gold);
        }

        .btn-login-nav:hover {
            background: transparent;
            color: var(--accent-gold);
            box-shadow: 0 0 20px rgba(179, 116, 40, 0.4);
        }
    </style>
</head>

<body>

    <header class="main-header">
        <div class="header-brand">
            <img src="{{ asset('img/LOGO.jpg') }}" alt="Logo Busana Laras" class="logo-header">
            <div class="brand-text">
                <h1>Busana Laras</h1>
                <p>Penyewaan Baju Tari & Adat</p>
            </div>
        </div>

        <nav>
            <a href="{{ route('login') }}" class="btn-login-nav shadow-lg">
                <i class="fas fa-lock-open mr-2"></i> Admin System
            </a>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto py-24 px-6">
        <div class="mb-20 text-center">
            <span class="text-[#B37428] font-bold uppercase tracking-[0.5em] text-sm">Eksplorasi Budaya</span>
            <h2 class="text-5xl font-black text-white uppercase mt-2 font-serif tracking-tight">Koleksi Tersedia</h2>
            <div class="flex justify-center items-center gap-4 mt-6">
                <div class="h-[1px] w-20 bg-white/20"></div>
                <div class="h-2 w-2 bg-[#B37428] rotate-45"></div>
                <div class="h-[1px] w-20 bg-white/20"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-14">
            @foreach ($baju as $row)
                <div class="baju-card">
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $row->foto) }}" class="w-full h-full object-cover">
                        <div class="stok-badge shadow-2xl uppercase">Stok: {{ $row->stok }} Unit</div>
                    </div>
                    <div class="info-content">
                        <h3 class="uppercase tracking-wide">{{ $row->nama_baju }}</h3>
                        <div class="divider"></div>
                        <div class="price-text">Rp {{ number_format($row->harga_sewa, 0, ',', '.') }}</div>
                        <p class="text-xs font-bold opacity-40 uppercase tracking-[0.2em] mt-1">Estimasi Sewa / Hari</p>

                        <div
                            class="mt-8 pt-6 border-t border-black/5 flex justify-center items-center gap-3 text-xs font-bold uppercase tracking-widest opacity-60">
                            <i class="fas fa-map-marker-alt text-[#B37428]"></i>
                            <span>Studio Busana Laras</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <footer class="py-16 text-center bg-[#2B2118] border-t-4 border-[#B37428]">
        <img src="{{ asset('img/LOGO.jpg') }}" class="w-12 h-12 mx-auto rounded-lg grayscale opacity-50 mb-4">
        <p class="text-white/30 font-bold uppercase text-[10px] tracking-[5px]">&copy; 2026 Busana Laras - Offline
            Management System</p>
    </footer>

</body>

</html>
