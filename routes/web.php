<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\TestimonialsController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', HomeController::class)->name('home');

Route::get('/about', AboutController::class)->name('about');


Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');

Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');

Route::get('/social-media-share', [PostsController::class,'ShareWidget']);

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
