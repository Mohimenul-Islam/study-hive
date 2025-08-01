<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ResourceController::class, 'index'])->name('dashboard');
    Route::get('/resources/upload', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
});

require __DIR__.'/auth.php';
