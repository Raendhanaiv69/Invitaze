<?php

use App\Http\Controllers\DesignEditorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// GUEST / DAFTAR TAMU ROUTES
Route::get('/daftartamu', [GuestController::class, 'index'])->name('daftartamu');
Route::post('/daftartamu', [GuestController::class, 'store'])->name('guests.store');

Route::get('/kustomdesain', function () {
    return view('dashboard.KustomDesain');
})->name('kustomdesain');

// DESIGN EDITOR ROUTES
Route::get('/editor', [DesignEditorController::class, 'edit'])->name('editor');
Route::get('/editor-alias', [DesignEditorController::class, 'edit'])->name('editor.index');
Route::post('/editor', [DesignEditorController::class, 'save'])->name('editor.save');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';