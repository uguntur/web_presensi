<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

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

    public function admin(Request $request)
    {
        $user = Auth::user();

        abort_if(!$user || $user->role !== 'admin', 403);

        $courses = Schema::hasTable('courses') ? Course::orderBy('name')->get() : collect();
        $users = Schema::hasTable('users') ? User::orderBy('name')->get() : collect();
        $userCount = $users->count();
        $todayAttendanceCount = Schema::hasTable('attendances') ? Attendance::whereDate('created_at', Carbon::today())->count() : 0;
        $selectedCourseId = $request->query('course_id');

        $attendances = Schema::hasTable('attendances') ? Attendance::with('user','course')->orderByDesc('created_at') : collect();
        if ($attendances instanceof \Illuminate\Database\Eloquent\Builder && $selectedCourseId) {
            $attendances = $attendances->where('course_id', $selectedCourseId);
        }
        $attendances = $attendances instanceof \Illuminate\Database\Eloquent\Builder ? $attendances->limit(50)->get() : $attendances;

        return view('dashboard.admin', compact('user','courses','attendances','users','userCount','todayAttendanceCount','selectedCourseId'));
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

        Course::create(array_merge(
            $request->only(['code','name','class']),
            ['admin_id' => $user->id]
        ));

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

    public function deleteAttendance(Request $request, $id)
    {
        $user = Auth::user();
        abort_if(!$user || $user->role !== 'admin', 403);

        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return back()->with('success', 'Presensi berhasil dihapus.');
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

    public function user(Request $request)
    {
        $user = Auth::user();

        abort_if(!$user || $user->role !== 'user', 403);

        $courses = Schema::hasTable('courses') ? Course::orderBy('name')->get() : collect();
        $selectedCourseId = $request->query('course_id');

        $userAttendances = Schema::hasTable('attendances') ? Attendance::with('course')->where('user_id', $user->id)->orderByDesc('created_at') : collect();
        if ($userAttendances instanceof \Illuminate\Database\Eloquent\Builder && $selectedCourseId) {
            $userAttendances = $userAttendances->where('course_id', $selectedCourseId);
        }
        $userAttendances = $userAttendances instanceof \Illuminate\Database\Eloquent\Builder ? $userAttendances->get() : $userAttendances;

        return view('dashboard.user', compact('user','courses','userAttendances','selectedCourseId'));
    }
}
