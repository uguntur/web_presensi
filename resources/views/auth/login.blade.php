<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Presensi - Team Fire Kelompok 11</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #e8f0fe;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Header / Logo Area */
        .header {
            text-align: center;
            margin-bottom: 24px;
        }
        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 8px;
        }
        .logo-circle {
            width: 70px;
            height: 70px;
            background: #1a3a8f;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .logo-circle img {
            width: 54px;
            height: 54px;
            object-fit: contain;
        }
        /* Flame SVG fallback if no image */
        .flame-svg { width: 38px; height: 46px; }

        .header-text { text-align: left; }
        .header-text h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1a3a8f;
            line-height: 1.1;
        }
        .header-text h1 span { color: #1565C0; }
        .header-text p {
            font-size: 13px;
            color: #555;
            margin-top: 2px;
        }
        .header-text .sub {
            font-size: 12px;
            color: #777;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1px solid #d0d8f0;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 13px;
            color: #1a3a8f;
            font-weight: 500;
            margin-top: 10px;
        }
        .badge-dot {
            width: 10px;
            height: 12px;
        }

        /* Card */
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 36px 28px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 24px rgba(26,58,143,0.10);
        }
        .card h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: #1565C0;
            margin-bottom: 22px;
        }

        /* Form */
        .input-group {
            position: relative;
            margin-bottom: 16px;
        }
        .input-group input {
            width: 100%;
            padding: 12px 44px 12px 16px;
            border: 1.5px solid #d0d8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #333;
            background: #fff;
            outline: none;
            transition: border-color 0.2s;
        }
        .input-group input:focus {
            border-color: #1565C0;
        }
        .input-group input::placeholder { color: #aab; }
        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab;
            font-size: 16px;
            pointer-events: none;
        }

        .btn-signin {
            width: 100%;
            padding: 13px;
            background: #1565C0;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            margin-top: 4px;
            letter-spacing: 0.3px;
            transition: background 0.2s;
        }
        .btn-signin:hover { background: #1a3a8f; }

        .register-link {
            text-align: center;
            margin-top: 16px;
            font-size: 13px;
            color: #555;
        }
        .register-link a {
            color: #1565C0;
            font-weight: 600;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }

        /* Error */
        .alert-success {
            background: #eafaf1;
            border: 1px solid #a9dfbf;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #1e8449;
            margin-bottom: 16px;
        }
        .alert-error {
            background: #fdecea;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #c0392b;
            margin-bottom: 16px;
        }

        /* Footer */
        .footer-text {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 16px;
        }

        /* Decorative bottom flames */
        .flames-bar {
            display: flex;
            justify-content: center;
            gap: 4px;
            margin-top: 28px;
            flex-wrap: wrap;
            max-width: 600px;
        }
        .flame-leaf {
            width: 18px;
            height: 28px;
        }
    </style>
</head>
<body>

    <!-- Logo & Title -->
    <div class="header">
        <div class="logo-wrapper">
            <div class="logo-circle">
                <svg class="flame-svg" viewBox="0 0 38 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 2C19 2 28 12 28 22C28 27.5 24.5 32 19 34C13.5 32 10 27.5 10 22C10 12 19 2 19 2Z" fill="#FF9800"/>
                    <path d="M19 12C19 12 24 19 24 25C24 28.3 21.8 31 19 32C16.2 31 14 28.3 14 25C14 19 19 12 19 12Z" fill="#FFF176"/>
                    <path d="M19 28C19 28 21 30 21 32C21 33.1 20.1 34 19 34C17.9 34 17 33.1 17 32C17 30 19 28 19 28Z" fill="#FF5722"/>
                    <ellipse cx="19" cy="40" rx="8" ry="4" fill="#1a3a8f" opacity="0.3"/>
                    <text x="19" y="44" text-anchor="middle" fill="white" font-size="7" font-family="sans-serif" font-weight="bold">FIRE</text>
                </svg>
            </div>
            <div class="header-text">
                <h1>SISTEM PRESENSI <span>UNP KEDIRI</span></h1>
                <p>Sistem Informasi Presensi</p>
                <p class="sub">Team Fire · Kelompok 11</p>
            </div>
        </div>
        <div>
            <span class="badge">
                <svg class="badge-dot" viewBox="0 0 10 12" fill="none">
                    <path d="M5 0C5 0 9 4 9 7.5C9 9.98 7.21 12 5 12C2.79 12 1 9.98 1 7.5C1 4 5 0 5 0Z" fill="#FF9800"/>
                </svg>
                Team Fire · Kelompok 11
            </span>
        </div>
    </div>

    <!-- Login Card -->
    <div class="card">
        <h2>Sign in to start your session</h2>

        @if (session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- Tampilkan error jika ada --}}
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="input-group">
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                >
                <span class="input-icon">&#128100;</span>
            </div>

            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="current-password"
                >
                <span class="input-icon">&#128274;</span>
            </div>

            <button type="submit" class="btn-signin">Sign In</button>
        </form>

        <p class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>

    <p class="footer-text">Team Fire · Kelompok 11 · Sistem Presensi</p>

    <!-- Decorative flames -->
    <div class="flames-bar">
        @for ($i = 0; $i < 24; $i++)
            <svg class="flame-leaf" viewBox="0 0 18 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 1C9 1 16 9 16 17C16 21.97 12.97 26 9 27C5.03 26 2 21.97 2 17C2 9 9 1 9 1Z"
                      fill="{{ ['#1565C0','#1a3a8f','#2196F3','#1976D2','#0d47a1'][$i % 5] }}"
                      opacity="{{ 0.5 + ($i % 5) * 0.1 }}"/>
            </svg>
        @endfor
    </div>

</body>
</html>
