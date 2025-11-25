<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;    
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoAdminController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::middleware(['auth'])->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
});
Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin/photos', [PhotoAdminController::class, 'index'])->name('admin.photos.index');
    Route::post('/admin/photos', [PhotoAdminController::class, 'store'])->name('admin.photos.store');
    Route::get('/admin/photos/{photo}/edit', [PhotoAdminController::class, 'edit'])->name('admin.photos.edit');
    Route::patch('/admin/photos/{photo}', [PhotoAdminController::class, 'update'])->name('admin.photos.update');
    Route::delete('/admin/photos/{photo}', [PhotoAdminController::class, 'destroy'])->name('admin.photos.destroy');
});

require __DIR__.'/auth.php';
