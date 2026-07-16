<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Auth\AuthController;

Route::post('/webhook/whatsapp', [WebhookController::class, 'terimaDariWhatsapp']);

Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Halaman Dashboard Utama SITABA
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    // Route untuk memproses Logout
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    
});
