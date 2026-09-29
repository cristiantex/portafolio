<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\FormacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TecnologiaController;
use Illuminate\Support\Facades\Route;

// Sitio público
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contacto', [ContactoController::class, 'store'])->middleware('throttle:3,10')->name('contacto.store');

// Acceso al mantenedor
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Mantenedor
Route::middleware('checkLogin')->group(function () {
    Route::get('/portafolio', [DashboardController::class, 'index'])->name('welcome');
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::resource('formacion', FormacionController::class)->except('show')->parameters(['formacion' => 'formacion']);
    Route::resource('tecnologias', TecnologiaController::class)->except('show');
    Route::resource('experiencias', ExperienciaController::class)->except('show');
    Route::resource('proyectos', ProyectoController::class)->except('show');

    Route::get('/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::patch('/mensajes/{mensaje}/leido', [MensajeController::class, 'toggleLeido'])->name('mensajes.leido');
    Route::delete('/mensajes/{mensaje}', [MensajeController::class, 'destroy'])->name('mensajes.destroy');
});
