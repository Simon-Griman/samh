<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MiEquipoController;
use App\Http\Controllers\NombreEquipoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    /*Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');*/

    Route::get('/home', function () {
        return view('index');
    })->name('home');

    Route::resource('/equipos', EquipoController::class)->middleware('can:equipos.index')->names('equipos');

    Route::get('/mis-equipos', [MiEquipoController::class, 'index'])->middleware('can:mis_equipos')->name('mis_equipos');
    Route::get('/mis-equipos-pdf', [MiEquipoController::class, 'downloadEquipos'])->middleware('can:mis_equipos')->name('mis_equipos.pdf');

    Route::resource('/nombre-equipos', NombreEquipoController::class)->middleware('can:nombre_equipos.index')->names('nombre_equipos');

    Route::resource('/users', UserController::class)->only('index', 'edit', 'update')->middleware('can:users.index')->names('users');

    Route::resource('/roles', RoleController::class)->middleware('can:roles.index')->names('roles');
});
