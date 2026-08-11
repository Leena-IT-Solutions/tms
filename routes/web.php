<?php

use App\Http\Controllers\GitUpdaterController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/git-info', [GitUpdaterController::class, 'info'])->name('git.info');
    Route::post('/git-update', [GitUpdaterController::class, 'update'])->name('git.update');
});

require __DIR__.'/auth.php';
