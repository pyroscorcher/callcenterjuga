<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;

Route::inertia('/', 'Welcome')->name('home');
Route::post('/webhook/whatsapp', [WebhookController::class, 'terimaDariWhatsapp']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
