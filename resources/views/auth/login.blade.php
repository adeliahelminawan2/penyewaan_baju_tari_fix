<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Busana Laras</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #372611;
            background-image: radial-gradient(#4d3618 1px, transparent 1px);
            background-size: 20px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #d4bfa9;
        }

        .login-card {
            background-color: #d4bfa9;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo-login {
            height: 80px;
            border-radius: 12px;
            margin-bottom: 1rem;
            border: 2px solid #B37428;
        }

        h2 {
            color: #372611;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            color: #372611;
            font-size: 0.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #bda893;
            background-color: rgba(255, 255, 255, 0.5);
            font-size: 1rem;
            color: #372611;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #B37428;
            background-color: white;
        }

        .btn-login {
            width: 100%;
            background-color: #B37428;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 900;
            font-size: 1rem;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background-color: #372611;
            transform: translateY(-2px);
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: #6d5b4b;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .back-link:hover {
            color: #B37428;
        }

        .error-list {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            list-style: none;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <img src="{{ asset('img/LOGO.jpg') }}" class="logo-login" alt="Logo">
        <h2>Admin Login</h2>

        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email / Username</label>
                <input type="email" name="email" required autofocus placeholder="Masukkan email...">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="********">
            </div>

            <button type="submit" class="btn-login">Masuk Sekarang</button>
        </form>

        <a href="/" class="back-link">← Kembali ke Katalog</a>
    </div>

</body>

</html>
