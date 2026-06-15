<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/', function () {
    return redirect()->route('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
    Route::post('/dashboard/admin/course', [DashboardController::class, 'storeCourse'])->name('dashboard.admin.course.store');
    Route::post('/dashboard/admin/attendance/{id}/update', [DashboardController::class, 'updateAttendance'])->name('dashboard.admin.attendance.update');
    Route::post('/dashboard/admin/attendance/{id}/delete', [DashboardController::class, 'deleteAttendance'])->name('dashboard.admin.attendance.delete');
    Route::post('/dashboard/admin/phone', [DashboardController::class, 'updatePhone'])->name('dashboard.admin.phone.update');
    Route::post('/attendance', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');