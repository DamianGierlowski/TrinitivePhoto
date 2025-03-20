<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/gallery', [GalleryController::class, 'index'])->middleware('auth')->name('gallery.index');
Route::get('/gallery/show/{guid}', [GalleryController::class, 'show'])->middleware('auth')->name('gallery.show');

require __DIR__.'/auth.php';
