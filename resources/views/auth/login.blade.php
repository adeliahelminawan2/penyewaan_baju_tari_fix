<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - Busana Laras</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #452717;
            --accent-gold: #865000;
            --bg-soft: #f4f1ee;
        }

        body {
            background-color: var(--primary-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: var(--bg-soft);
            border-radius: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(255, 255, 255, 0.525);
            width: 100%;
            max-width: 450px;
            padding: 3.5rem 3rem;
            border-top: 10px solid var(--accent-gold);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: var(--accent-gold);
            opacity: 0.05;
            border-radius: 50%;
        }

        .btn-login {
            background-color: var(--primary-dark);
            color: rgb(237, 183, 64);
            border: none;
            padding: 1.2rem;
            border-radius: 1.2rem;
            font-weight: 800;
            letter-spacing: 2px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .btn-login:hover {
            background-color: var(--accent-gold);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(179, 116, 40, 0.3);
        }

        .form-control {
            border-radius: 1.2rem;
            padding: 1rem 1.5rem;
            border: 2px solid transparent;
            background-color: #ffffff;
            font-weight: 700;
            color: var(--primary-dark);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 5px rgba(179, 116, 40, 0.1);
            background-color: #fff;
        }

        .form-label {
            font-weight: 800;
            font-size: 0.7rem;
            color: var(--primary-dark);
            opacity: 0.6;
            margin-bottom: 0.75rem;
            letter-spacing: 1.5px;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="login-card text-center shadow-lg">
        <div class="mb-5">
            <img src="{{ asset('img/LOGO.jpg') }}" alt="Logo Busana Laras" class="logo-img rounded-circle mb-4">
            <h2 class="fw-black text-dark text-uppercase mb-1" style="letter-spacing: -1px; font-size: 1.75rem;">
                Admin <span style="color: var(--accent-gold);">Masuk</span>
            </h2>
            <p class="text-muted small fw-bold text-uppercase tracking-widest mb-0 opacity-50">Sistem Busana Laras</p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger text-start small mb-4 border-0 shadow-sm rounded-4 px-4 py-3">
                <ul class="mb-0 ps-0 list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li class="fw-bold"><i class="fas fa-exclamation-circle me-2"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4 text-start">
                <label class="form-label text-uppercase">Alamat Email</label>
                <div class="position-relative">
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required autofocus>
                </div>
            </div>

            <div class="mb-5 text-start">
                <label class="form-label text-uppercase">Kata Sandi</label>
                <div class="position-relative">
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 mb-4 shadow-sm">
                Masuk Sekarang <i class="fas fa-sign-in-alt ms-2"></i>
            </button>
        </form>

        <a href="/" class="text-decoration-none text-muted small fw-bold text-uppercase tracking-widest opacity-50 hover-opacity-100 transition-all">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Katalog
        </a>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
