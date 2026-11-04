<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HrDashboardController;
use App\Http\Controllers\OfficerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('dashboard')
            : redirect()->route('hr.dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('departments', DepartmentController::class)->except('show');
        Route::delete('/officers/{officer}', [OfficerController::class, 'destroy'])->name('officers.destroy');
    });

    // HR 
    Route::middleware('role:hr')->group(function () {
        Route::get('/hr/dashboard', [HrDashboardController::class, 'index'])->name('hr.dashboard');
    });

    // Admin and HR
    Route::middleware('role:admin,hr')->group(function () {
        Route::resource('officers', OfficerController::class)->except(['show', 'destroy']);
    });
});