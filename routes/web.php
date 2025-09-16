<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FormacionController;
use App\Http\Controllers\TecnologiaController;

// Route::get('/', function () { return view('welcome');});
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/portafolio', function () {
    return view('welcome');
})->name('welcome')->middleware('checkLogin');

Route::middleware('checkLogin')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
});

Route::prefix('formacion')->group(function () {
    Route::get('/', [FormacionController::class, 'index'])->name('formacion.index');
    Route::get('/create', [FormacionController::class, 'create'])->name('formacion.create');
    Route::post('/store', [FormacionController::class, 'store'])->name('formacion.store');
    Route::get('/{formacion}/edit', [FormacionController::class, 'edit'])->name('formacion.edit');
    Route::put('/{formacion}', [FormacionController::class, 'update'])->name('formacion.update');
    Route::delete('/{formacion}', [FormacionController::class, 'destroy'])->name('formacion.destroy');
});

Route::prefix('tecnologias')->group(function () {
    Route::get('/', [TecnologiaController::class, 'index'])->name('tecnologias.index');
    Route::get('/create', [TecnologiaController::class, 'create'])->name('tecnologias.create');
    Route::post('/store', [TecnologiaController::class, 'store'])->name('tecnologias.store');
    Route::get('/{tecnologia}/edit', [TecnologiaController::class, 'edit'])->name('tecnologias.edit');
    Route::put('/{tecnologia}', [TecnologiaController::class, 'update'])->name('tecnologias.update');
    Route::delete('/{tecnologia}', [TecnologiaController::class, 'destroy'])->name('tecnologias.destroy');
});