<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Presensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2ff;
            min-height: 100vh;
            color: #111827;
        }
        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 28px 24px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }
        .header h1 { font-size: 30px; color: #1e3a8a; }
        .header p { color: #475569; margin-top: 6px; }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        }
        .card h2 { font-size: 18px; color: #0f172a; margin-bottom: 10px; }
        .card p { color: #475569; line-height: 1.6; }
        .panel {
            background: #fff;
            border-radius: 24px;
            padding: 26px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        }
        .panel h3 { font-size: 20px; color: #0f172a; margin-bottom: 14px; }
        .panel ul { list-style: none; display: grid; gap: 12px; }
        .panel li {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 16px;
            background: #f8fafc;
            color: #334155;
        }
        .button-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 18px;
            padding: 12px 18px;
            color: #fff;
            background: #2563eb;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
        }
        .stats { display: flex; gap: 14px; flex-wrap: wrap; }
        .stat-block {
            flex: 1;
            min-width: 180px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 18px;
            padding: 20px;
            color: #1e3a8a;
        }
        .stat-block strong { display: block; font-size: 28px; margin-bottom: 8px; }
        .footer { margin-top: 32px; color: #64748b; font-size: 14px; }
        @media (max-width: 900px) {
            .card-grid { grid-template-columns: 1fr; }
            .header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Selamat datang, {{ $user->name }}. Anda masuk sebagai administrator.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="button-logout">Keluar</button>
            </form>
        </div>

        <div class="stats">
            <div class="stat-block">
                <strong>100+</strong>
                Pengguna terdaftar
            </div>
            <div class="stat-block">
                <strong>28</strong>
                Presensi hari ini
            </div>
            <div class="stat-block">
                <strong>5</strong>
                Notifikasi belum dibaca
            </div>
        </div>

        <div class="card-grid">
            <div class="card">
                <h2>Kelola Pengguna</h2>
                <p>Tambahkan, edit, atau hapus akun pengguna. Semuanya bisa dikendalikan dari sini.</p>
            </div>
            <div class="card">
                <h2>Laporan Presensi</h2>
                <p>Lihat ringkasan kehadiran, statistik harian, dan rekap per kelas.</p>
            </div>
            <div class="card">
                <h2>Pengaturan Sistem</h2>
                <p>Atur peran, hak akses, jadwal, dan aturan presensi untuk seluruh pengguna.</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 360px 1fr; gap: 18px; margin-top: 22px;">
            <div class="panel">
                <h3>Tambah Mata Kuliah</h3>
                @if(session('success'))
                    <div style="background:#eafaf1;border:1px solid #a9dfbf;padding:10px;border-radius:8px;margin-bottom:10px;color:#1e8449;">{{ session('success') }}</div>
                @endif
                <form action="{{ route('dashboard.admin.course.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom:10px;">
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155">Kode Mata Kuliah</label>
                        <input name="code" placeholder="TIF1024" style="width:100%;padding:10px;border:1px solid #e2e8f0;border-radius:10px;">
                    </div>
                    <div style="margin-bottom:10px;">
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155">Nama Mata Kuliah</label>
                        <input name="name" required placeholder="Data Mining" style="width:100%;padding:10px;border:1px solid #e2e8f0;border-radius:10px;">
                    </div>
                    <div style="margin-bottom:10px;">
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155">Kelas</label>
                        <input name="class" placeholder="3C" style="width:100%;padding:10px;border:1px solid #e2e8f0;border-radius:10px;">
                    </div>
                    <button type="submit" style="background:#1e3a8a;color:#fff;padding:10px 12px;border-radius:10px;border:none;font-weight:600;">Tambah Mata Kuliah</button>
                </form>

                <hr style="border-top:1px solid #eef2ff;margin:14px 0">

                <h3>Nomor Telepon Admin</h3>
                <form action="{{ route('dashboard.admin.phone.update') }}" method="POST">
                    @csrf
                    <div style="margin-bottom:10px;">
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155">Telepon</label>
                        <input name="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="0812xxxx" style="width:100%;padding:10px;border:1px solid #e2e8f0;border-radius:10px;">
                    </div>
                    <button type="submit" style="background:#16a34a;color:#fff;padding:10px 12px;border-radius:10px;border:none;font-weight:600;">Simpan Nomor</button>
                </form>
            </div>

            <div class="panel">
                <h3>Daftar Presensi Terbaru</h3>
                <table style="width:100%;border-collapse:collapse;font-size:14px;color:#334155">
                    <thead>
                        <tr style="text-align:left;border-bottom:1px solid #e6eefb">
                            <th style="padding:10px">No</th>
                            <th style="padding:10px">Mahasiswa</th>
                            <th style="padding:10px">Mata Kuliah</th>
                            <th style="padding:10px">Waktu</th>
                            <th style="padding:10px">Status</th>
                            <th style="padding:10px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $i => $a)
                            <tr style="border-bottom:1px solid #f1f5fb">
                                <td style="padding:10px;vertical-align:top">{{ $i+1 }}</td>
                                <td style="padding:10px;vertical-align:top">{{ $a->user->name ?? '—' }}<br><small style="color:#64748b">{{ $a->user->email ?? '' }}</small></td>
                                <td style="padding:10px;vertical-align:top">{{ $a->course->name ?? '-' }} <br><small style="color:#64748b">{{ $a->course->code ?? '' }}</small></td>
                                <td style="padding:10px;vertical-align:top">{{ $a->created_at->format('Y-m-d H:i') }}</td>
                                <td style="padding:10px;vertical-align:top">{{ $a->status ?? ($a->type ?? '') }}</td>
                                <td style="padding:10px;vertical-align:top">
                                    <form action="{{ route('dashboard.admin.attendance.update', $a->id) }}" method="POST" style="display:flex;gap:8px;align-items:center">
                                        @csrf
                                        <select name="status" style="padding:8px;border-radius:8px;border:1px solid #e2e8f0">
                                            <option value="hadir" {{ ($a->status=='hadir')? 'selected':'' }}>Hadir</option>
                                            <option value="izin" {{ ($a->status=='izin')? 'selected':'' }}>Izin</option>
                                            <option value="sakit" {{ ($a->status=='sakit')? 'selected':'' }}>Sakit</option>
                                        </select>
                                        <button type="submit" style="background:#2563eb;color:#fff;padding:8px 10px;border-radius:8px;border:none;font-weight:600;">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($attendances->isEmpty())
                            <tr><td colspan="6" style="padding:12px;color:#64748b">Belum ada presensi.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer">Sistem Presensi - Tampilan Admin</div>
    </div>
</body>
</html>
