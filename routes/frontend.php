<?php

use App\Http\Controllers\ContenusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil/{user}', [ProfilController::class, 'index'])->name('profil');


Route::get('/profil/{user}', [ProfilController::class, 'index'])->name('profil');

Route::get('/contenu/{id}', [ContenusController::class, 'show'])->name('contenu.show');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class, 'register'])->name('register.submit');