<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\WhatsAppController ;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [authController::class, 'login'])->name('verificaUsuario');
Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::get('/home', [homeController::class, 'index'])->name('principal');
Route::get('/pagos', [homeController::class, 'pagos'])->name('pagos');
Route::get('/deudas', [homeController::class, 'deudas'])->name('deudas');
// En routes/web.php
Route::post('/deudas/registrar', [HomeController::class, 'registarDeuda'])->name('registarDeuda');

Route::get('/pagar-deuda', [HomeController::class, 'pagarDeuda'])->name('pagarDeuda');