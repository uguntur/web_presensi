<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('register');
        }

        return $user->role === 'admin'
            ? redirect()->route('dashboard.admin')
            : redirect()->route('dashboard.user');
    }

    public function admin()
    {
        $user = Auth::user();

        abort_if(!$user || $user->role !== 'admin', 403);

        $courses = Schema::hasTable('courses') ? Course::orderBy('name')->get() : collect();
        $attendances = Schema::hasTable('attendances') ? Attendance::with('user','course')->orderByDesc('created_at')->limit(50)->get() : collect();

        return view('dashboard.admin', compact('user','courses','attendances'));
    }

    public function storeCourse(Request $request)
    {
        $user = Auth::user();
        abort_if(!$user || $user->role !== 'admin', 403);

        $request->validate([
            'code' => 'nullable|string|max:50',
            'name' => 'required|string|max:191',
            'class' => 'nullable|string|max:50',
        ]);

        Course::create($request->only(['code','name','class']));

        return back()->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function updateAttendance(Request $request, $id)
    {
        $user = Auth::user();
        abort_if(!$user || $user->role !== 'admin', 403);

        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:hadir,izin,sakit',
        ]);

        $attendance->status = $request->input('status');
        $attendance->save();

        return back()->with('success', 'Status presensi berhasil diperbarui.');
    }

    public function updatePhone(Request $request)
    {
        $user = Auth::user();
        abort_if(!$user || $user->role !== 'admin', 403);

        $request->validate([
            'phone' => 'nullable|string|max:30',
        ]);

        $user->phone = $request->input('phone');
        $user->save();

        return back()->with('success', 'Nomor telepon admin berhasil disimpan.');
    }

    public function user()
    {
        $user = Auth::user();

        abort_if(!$user || $user->role !== 'user', 403);

        $courses = Schema::hasTable('courses') ? Course::orderBy('name')->get() : collect();
        return view('dashboard.user', compact('user','courses'));
    }
}
