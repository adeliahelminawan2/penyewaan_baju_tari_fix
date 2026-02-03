<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Busana Laras</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #3D2B1F;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: white;
        }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .text-gold { color: #B37428; }
        .btn-gold { 
            background-color: #B37428; color: white; border: 2px solid #B37428; 
            font-weight: bold; text-transform: uppercase; letter-spacing: 1px;
        }
        .btn-gold:hover { background-color: transparent; color: #B37428; }
        .card-baju {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s;
            background-color: #E2D1C3;
        }
        .card-baju:hover { transform: translateY(-10px); }
        .card-img-wrapper { height: 400px; overflow: hidden; position: relative; }
        .card-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .card-baju:hover .card-img-wrapper img { transform: scale(1.1); }
        .badge-stok { 
            position: absolute; top: 15px; right: 15px; 
            background-color: #2B2118; color: white; 
            padding: 8px 15px; border-radius: 8px; font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-dark bg-dark border-bottom border-warning border-4 py-3 sticky-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="#">
                <img src="{{ asset('img/LOGO.jpg') }}" alt="Logo" class="rounded-3 border border-warning" style="width: 60px; height: 60px; object-fit: cover;">
                <div>
                    <h1 class="h3 mb-0 text-warning fw-bold text-uppercase ls-1">Busana Laras</h1>
                    <small class="text-white-50 fst-italic" style="letter-spacing: 1px;">Penyewaan Baju Tari & Adat</small>
                </div>
            </a>
            <a href="{{ route('login') }}" class="btn btn-gold rounded-pill px-4 shadow-sm">
                <i class="fas fa-lock-open me-2"></i> Admin System
            </a>
        </div>
    </nav>

    <!-- Hero / Content -->
    <div class="container py-5">
        <div class="text-center mb-5 mt-4">
            <span class="text-warning fw-bold text-uppercase ls-2 small d-block mb-2">Eksplorasi Budaya</span>
            <h2 class="display-4 fw-black text-white text-uppercase">Koleksi Tersedia</h2>
            <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
                <div class="bg-white opacity-25" style="height: 1px; width: 60px;"></div>
                <div class="bg-warning" style="width: 10px; height: 10px; transform: rotate(45deg);"></div>
                <div class="bg-white opacity-25" style="height: 1px; width: 60px;"></div>
            </div>
        </div>

        <div class="row g-5">
            @foreach ($baju as $row)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-baju h-100 shadow-lg">
                        <div class="card-img-wrapper">
                            <img src="{{ asset('storage/' . $row->foto) }}" alt="{{ $row->nama_baju }}">
                            <div class="badge-stok shadow text-uppercase small border border-warning">Stok: {{ $row->stok }} Unit</div>
                        </div>
                        <div class="card-body text-center p-4 text-dark">
                            <h3 class="h4 fw-bold text-uppercase mb-3">{{ $row->nama_baju }}</h3>
                            <div class="bg-warning mx-auto mb-3" style="height: 3px; width: 40px; border-radius: 2px;"></div>
                            <h4 class="text-warning fw-bold mb-1">Rp {{ number_format($row->harga_sewa, 0, ',', '.') }}</h4>
                            <small class="text-muted fw-bold text-uppercase ls-1" style="font-size: 0.7rem;">Estimasi Sewa / Hari</small>

                            <div class="border-top border-secondary border-opacity-10 mt-4 pt-3 d-flex justify-content-center align-items-center gap-2 text-muted small fw-bold text-uppercase ls-1">
                                <i class="fas fa-map-marker-alt text-warning"></i>
                                <span>Studio Busana Laras</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-5 border-top border-warning border-4 mt-5">
        <div class="container">
            <img src="{{ asset('img/LOGO.jpg') }}" class="mb-3 rounded opacity-50 grayscale" style="width: 50px; height: 50px;">
            <p class="text-white-50 small fw-bold text-uppercase ls-2 mb-0">&copy; 2026 Busana Laras - Offline Management System</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
