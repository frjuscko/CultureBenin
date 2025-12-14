<?php

use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ContenusController;
use Illuminate\Support\Facades\Route;


// Routes protégés
Route::middleware(['moderateur'])->group(function () {
    Route::get('lescontenus', [ContenusController::class, 'nonVal'])->name('lescontenus');
    Route::post('/contenus/contenuval', [ContenusController::class, 'valider'])->name('contenu.val');
});

