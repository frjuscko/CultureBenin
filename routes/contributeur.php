<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ContenusController;
use Illuminate\Support\Facades\Route;


// Routes protégés
Route::middleware(['contributeur'])->group(function () {
    Route::get('/contenus/ajouter', [ContenusController::class, 'create'])->name('AjoutContenu');
    Route::post('/contenus/contenuadd', [ContenusController::class, 'store'])->name('contenu.store');
});

