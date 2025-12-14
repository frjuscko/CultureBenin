<?php

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ContenusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('editerprofil', [ProfilController::class, 'edit'])->name('profiledit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/photo/delete', [ProfilController::class, 'deletePhoto'])->name('profil.photo.delete');

    Route::get('/bord', [UserController::class, 'index'])->name('bord');
    
    Route::get('/contenus', [ContenusController::class, 'index'])->name('contenus');
});



require __DIR__.'/admin.php';
require __DIR__.'/contributeur.php';
require __DIR__.'/moderateur.php';


