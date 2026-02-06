<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ActualiteAdminController;
use App\Http\Controllers\Admin\CategorieAdminController;
use App\Http\Controllers\Admin\CoachAdminController;
use App\Http\Controllers\Admin\JoueurAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::resource('categories', CategorieController::class)->only(['index', 'show']);
Route::resource('actualites', ActualiteController::class)->only(['index', 'show']);
Route::get('/emploi-du-temps', [\App\Http\Controllers\EmploiDuTempsController::class, 'index'])->name('emploi-du-temps.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Emploi du temps (admin)
    Route::middleware('admin')->group(function () {
        Route::resource('emploi-du-temps', \App\Http\Controllers\EmploiDuTempsController::class)->except(['index', 'show']);
    });
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'admin'])
    ->group(function () {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::resource('actualites', ActualiteAdminController::class)->except(['show']);
        Route::resource('categories', CategorieAdminController::class)->except(['show']);
        Route::resource('coaches', CoachAdminController::class)->except(['show']);
        Route::resource('joueurs', JoueurAdminController::class)->except(['show']);
        Route::resource('users', UserAdminController::class)->except(['show', 'create', 'store']);
    });

require __DIR__.'/auth.php';
