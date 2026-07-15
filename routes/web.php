<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Api\WebhookController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::post('/webhook/whatsapp', [WebhookController::class, 'terimaDariWhatsapp']);

require __DIR__.'/settings.php';
