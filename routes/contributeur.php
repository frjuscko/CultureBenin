<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ContenusController;
use Illuminate\Support\Facades\Route;


// Routes protégés
Route::middleware(['contributeur'])->group(function () {
    Route::get('/contributeur', [UsersController::class, 'index'])->name('dashboardcontributeur');
    Route::get('mescontenus', [ContenusController::class, 'index'])->name('mescontenus');
    Route::get('/contenus/ajouter', [ContenusController::class, 'create'])->name('AjoutContenu');
    Route::post('/contenus/contenuadd', [ContenusController::class, 'store'])->name('contenu.store');
});

