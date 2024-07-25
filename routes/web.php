<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\EPHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\TestimonialsController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', HomeController::class)->name('home');

Route::view('policy', 'policy')->name('policy');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products-list', [ProductController::class, 'list'])->name('products.list');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

Route::get('/jobs-list', [JobController::class, 'list'])->name('jobs.list');

Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/epsolutions', EPHomeController::class)->name('ephome');

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
