<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Presensi UNP Kediri</title>
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
        }
        .flame-svg { width: 38px; height: 46px; }
        .header-text { text-align: left; }
        .header-text h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1a3a8f;
            line-height: 1.1;
        }
        .header-text h1 span { color: #1565C0; }
        .header-text p { font-size: 13px; color: #555; margin-top: 2px; }
        .header-text .sub { font-size: 12px; color: #777; }
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

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 32px 36px 28px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 4px 24px rgba(26,58,143,0.10);
        }
        .card h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: #1565C0;
            margin-bottom: 22px;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 11px 44px 11px 16px;
            border: 1.5px solid #d0d8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #333;
            background: #fff;
            outline: none;
            transition: border-color 0.2s;
        }
        .input-group input:focus { border-color: #1565C0; }
        .input-group input::placeholder { color: #aab; }
        .input-group input.is-invalid { border-color: #e74c3c; }
        .input-icon {
            position: absolute;
            right: 14px;
            bottom: 11px;
            color: #aab;
            font-size: 16px;
            pointer-events: none;
        }
        .field-error {
            font-size: 11px;
            color: #e74c3c;
            margin-top: 4px;
        }

        .btn-register {
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
            transition: background 0.2s;
        }
        .btn-register:hover { background: #1a3a8f; }

        .login-link {
            text-align: center;
            margin-top: 16px;
            font-size: 13px;
            color: #555;
        }
        .login-link a {
            color: #1565C0;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover { text-decoration: underline; }

        .alert-error {
            background: #fdecea;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #c0392b;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #eafaf1;
            border: 1px solid #a9dfbf;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #1e8449;
            margin-bottom: 16px;
        }

        .footer-text {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 16px;
        }

        .flames-bar {
            display: flex;
            justify-content: center;
            gap: 4px;
            margin-top: 28px;
            flex-wrap: wrap;
            max-width: 600px;
        }
        .flame-leaf { width: 18px; height: 28px; }

        .divider {
            border: none;
            border-top: 1px solid #e8eef8;
            margin: 4px 0 16px;
        }
    </style>
</head>
<body>

    <!-- Logo -->
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
                <svg width="10" height="12" viewBox="0 0 10 12" fill="none">
                    <path d="M5 0C5 0 9 4 9 7.5C9 9.98 7.21 12 5 12C2.79 12 1 9.98 1 7.5C1 4 5 0 5 0Z" fill="#FF9800"/>
                </svg>
                Team Fire · Kelompok 11
            </span>
        </div>
    </div>

    <!-- Register Card -->
    <div class="card">
        <h2>Buat Akun Baru</h2>
        <hr class="divider">

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="input-group">
                <label for="name">Nama Lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('name') }}"
                    required
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                >
                <span class="input-icon">&#128100;</span>
                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="input-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                >
                <span class="input-icon">&#9993;</span>
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    required
                    autocomplete="new-password"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                >
                <span class="input-icon">&#128274;</span>
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                    autocomplete="new-password"
                >
                <span class="input-icon">&#128274;</span>
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>

        <p class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>

    <p class="footer-text">Team Fire · Kelompok 11 · Sistem Presensi</p>

    <!-- Decorative flames -->
    <div class="flames-bar">
        @php $colors = ['#1565C0','#1a3a8f','#2196F3','#1976D2','#0d47a1']; @endphp
        @for ($i = 0; $i < 24; $i++)
            <svg class="flame-leaf" viewBox="0 0 18 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 1C9 1 16 9 16 17C16 21.97 12.97 26 9 27C5.03 26 2 21.97 2 17C2 9 9 1 9 1Z"
                      fill="{{ $colors[$i % 5] }}"
                      opacity="{{ 0.5 + ($i % 5) * 0.1 }}"/>
            </svg>
        @endfor
    </div>

</body>
</html>
