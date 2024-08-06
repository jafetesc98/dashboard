<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('/', 'loginView')->name('login.index');//esta es la ruta
    Route::get('dashboard1', 'arreglo')->name('login.arreglo');//esta es la ruta para el arreglo 
    Route::get('clientes', 'cuentaClientes')->name('login.cuentaClientes');//esta es la ruta para los datos de los clientes
    Route::get('grafica', 'ventaXsublinea')->name('login.ventaXsublinea');//ruta para actualizar la grafica
    Route::get('cli', 'clientescomp')->name('login.clientescomp');//ruta para actualizar la grafica
});
