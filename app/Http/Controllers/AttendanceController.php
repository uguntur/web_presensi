<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|string|in:hadir,izin,sakit',
        ]);

        $courseId = $request->input('course_id');

        $exists = Attendance::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah melakukan presensi untuk matkul ini hari ini.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'type' => 'in',
            'status' => $request->input('status'),
            'course_id' => $courseId,
            'metadata' => null,
        ]);

        return redirect()->route('dashboard.user', ['course_id' => $courseId])->with('success', 'Presensi berhasil dicatat.');
    }
}
