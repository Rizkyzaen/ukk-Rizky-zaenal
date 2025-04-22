<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .hero-section {
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradien untuk background */
            color: white;
            padding: 100px 0;
            position: relative;
            text-align: center;
            border-bottom: 4px solid rgba(255, 255, 255, 0.3);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3); /* Overlay lebih lembut */
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            animation: fadeIn 2s ease-out;
        }

        .hero-content p {
            font-size: 1.5rem;
            font-weight: 300;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeIn 2s ease-out 0.5s;
        }

        /* Animasi untuk fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .btn-custom {
            background-color: #ff6f61;
            border-color: #ff6f61;
            padding: 14px 40px;
            font-size: 18px;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-top: 30px;
            animation: slideIn 1s ease-out;
        }

        .btn-custom:hover {
            background-color: #e84f3f;
            border-color: #e84f3f;
            transform: scale(1.1);
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 14px 40px;
            font-size: 18px;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-top: 30px;
            margin-left: 15px;
            animation: slideIn 1s ease-out 0.3s;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #5a6268;
            transform: scale(1.1);
        }

        .btn-secondary-custom:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(108, 117, 125, 0.8);
        }

        .footer {
            text-align: center;
            padding: 30px 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .footer p {
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Selamat Datang di Perpustakaan</h1>
            <p class="lead">Temukan koleksi buku terbaik kami dengan mudah.</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-custom">Masuk </a>
                <a href="{{ route('register') }}" class="btn btn-secondary-custom">Daftar Akun</a>
            </div>
        </div>
    </div>

    {{-- <div class="footer">
        <p>&copy; 2025 Perpustakaan Digital | Semua Hak Cipta Dilindungi</p>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
