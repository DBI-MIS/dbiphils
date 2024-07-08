<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialsController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', HomeController::class)->name('home');

Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
