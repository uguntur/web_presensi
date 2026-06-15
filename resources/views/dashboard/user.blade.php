<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Sistem Presensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #0f172a;
        }
        .page {
            max-width: 1000px;
            margin: 0 auto;
            padding: 28px 24px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }
        .header h1 { font-size: 30px; color: #0f172a; }
        .header p { color: #475569; margin-top: 6px; }
        .profile-card {
            background: #fff;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
            margin-bottom: 24px;
        }
        .profile-card h2 { font-size: 20px; margin-bottom: 10px; }
        .info-list { display: grid; gap: 16px; }
        .info-item {
            background: #eff6ff;
            border-radius: 16px;
            padding: 18px 20px;
        }
        .info-item strong { display: block; font-size: 26px; margin-bottom: 6px; color: #1e3a8a; }
        .info-item span { color: #475569; }
        .schedule {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }
        .card {
            background: #fff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        }
        .card h3 { font-size: 18px; margin-bottom: 10px; }
        .card p { color: #475569; line-height: 1.6; }
        .button-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            color: #fff;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
        }
        .logout-form { margin-left: auto; }
        @media (max-width: 780px) {
            .schedule { grid-template-columns: 1fr; }
            .header { flex-direction: column; align-items: flex-start; }
            .logout-form { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div>
                <h1>Dashboard Pengguna</h1>
                <p>Halo, {{ $user->name }}! Ini adalah ringkasan aktivitas Anda.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="button-logout">Keluar</button>
            </form>
        </div>

        <div class="profile-card">
            <h2>Informasi Akun</h2>
            <div class="info-list">
                <div class="info-item">
                    <strong>{{ $user->name }}</strong>
                    <span>Nama lengkap</span>
                </div>
                <div class="info-item">
                    <strong>{{ $user->email }}</strong>
                    <span>Email terdaftar</span>
                </div>
                <div class="info-item">
                    <strong>{{ ucfirst($user->role) }}</strong>
                    <span>Peran pengguna</span>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:18px; text-align:center;">
            <h3>Presensi</h3>
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf
                <div style="max-width:320px;margin:8px auto 0;text-align:left;">
                    <label style="display:block;font-size:13px;color:#475569;margin-bottom:6px;font-weight:600">Pilih Mata Kuliah</label>
                    <select name="course_id" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #d0d8f0;background:#fff">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ $selectedCourseId == $c->id ? 'selected' : '' }}>{{ $c->code ? $c->code . ' - ' : '' }}{{ $c->name }} {{ $c->class ? '(' . $c->class . ')' : '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="max-width:320px;margin:12px auto 0;text-align:left;">
                    <label style="display:block;font-size:13px;color:#475569;margin-bottom:6px;font-weight:600">Status Kehadiran</label>
                    <select name="status" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #d0d8f0;background:#fff">
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                    </select>
                </div>
                <button type="submit" class="btn-register" style="max-width:260px;margin:12px auto 0;">Presensi Sekarang</button>
            </form>
            @if(session('success'))
                <div style="margin-top:10px;color:green;font-weight:600">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="margin-top:10px;color:#c0392b;font-weight:600">{{ session('error') }}</div>
            @endif
        </div>

        <div class="card" style="margin-bottom:18px;">
            <h3>Riwayat Presensi {{ $selectedCourseId ? ' (' . optional($courses->firstWhere('id', $selectedCourseId))->name . ')' : '' }}</h3>
            <form method="GET" action="{{ route('dashboard.user') }}" style="margin-bottom:16px;display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
                <label style="font-weight:600;color:#334155">Tampilkan matkul</label>
                <select name="course_id" style="padding:10px;border-radius:10px;border:1px solid #e2e8f0;min-width:220px;">
                    <option value="">Semua Mata Kuliah</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $selectedCourseId == $course->id ? 'selected' : '' }}>{{ $course->code ? $course->code . ' - ' : '' }}{{ $course->name }}{{ $course->class ? ' (' . $course->class . ')' : '' }}</option>
                    @endforeach
                </select>
                <button type="submit" style="background:#1e40af;color:#fff;padding:10px 14px;border-radius:10px;border:none;font-weight:600;">Tampilkan</button>
            </form>
            <table style="width:100%;border-collapse:collapse;font-size:14px;color:#334155">
                <thead>
                    <tr style="text-align:left;border-bottom:1px solid #e6eefb">
                        <th style="padding:10px">No</th>
                        <th style="padding:10px">Mata Kuliah</th>
                        <th style="padding:10px">Tanggal</th>
                        <th style="padding:10px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userAttendances as $i => $attendance)
                        <tr style="border-bottom:1px solid #f1f5fb">
                            <td style="padding:10px;vertical-align:top">{{ $i+1 }}</td>
                            <td style="padding:10px;vertical-align:top">{{ $attendance->course->name ?? '-' }}<br><small style="color:#64748b">{{ $attendance->course->code ?? '' }}</small></td>
                            <td style="padding:10px;vertical-align:top">{{ $attendance->created_at->format('Y-m-d H:i') }}</td>
                            <td style="padding:10px;vertical-align:top">{{ ucfirst($attendance->status ?? $attendance->type) }}</td>
                        </tr>
                    @endforeach
                    @if($userAttendances->isEmpty())
                        <tr><td colspan="4" style="padding:12px;color:#64748b">Belum ada presensi.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
