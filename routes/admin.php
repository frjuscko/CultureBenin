<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\UtilisateursController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Routes protégés
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name(name: 'Admin.dashboard');

    Route::get('/utilisateurs', [UtilisateursController::class, 'index'])->name('utilisateurs');
    Route::get('/langues', [LanguesController::class, 'index'])->name('langues');
    Route::get('/regions', [RegionsController::class, 'index'])->name('regions');
    Route::post('/utilisateurs/role', [UtilisateursController::class, 'storeRole'])->name('role.store');
    Route::post('/langues/langueadd', [LanguesController::class, 'addlangue'])->name('langue.store');
    Route::post('/regions/regionadd', [RegionsController::class, 'addregion'])->name('region.store');

    Route::post('/langues', [LanguesController::class, 'supprimer'])->name('lang.del');
    Route::post('/regions', [RegionsController::class, 'supprimer'])->name('reg.del');
});