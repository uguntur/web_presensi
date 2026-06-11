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
            'course_id' => 'nullable|exists:courses,id',
        ]);

        // check already attended today
        $exists = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'type' => 'in',
            'status' => 'hadir',
            'course_id' => $request->input('course_id'),
            'metadata' => null,
        ]);

        return back()->with('success', 'Presensi berhasil dicatat.');
    }
}
