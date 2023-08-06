<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MiEquipoController;
use App\Http\Controllers\NombreEquipoController;
use App\Http\Controllers\NombreMarcaController;
use App\Http\Controllers\NombreModeloController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolEquipoController;
use App\Http\Controllers\SolicitudController;
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

    Route::resource('/inventario', InventarioController::class)->middleware('can:inventario.index')->names('inventario');

    Route::get('/mis-equipos', [MiEquipoController::class, 'index'])->middleware('can:mis_equipos')->name('mis_equipos');
    Route::get('/mis-equipos-pdf', [MiEquipoController::class, 'downloadEquipos'])->middleware('can:mis_equipos')->name('mis_equipos.pdf');

    Route::get('/solicitar', [SolicitudController::class, 'solicitar'])->middleware('can:solicitar')->name('solicitar');

    Route::get('/solicitudes', [SolicitudController::class, 'solicitudes'])->middleware('can:solicitudes')->name('solicitudes');

    Route::resource('/nombre-equipos', NombreEquipoController::class)->middleware('can:nombre_equipos.index')->names('nombre_equipos');

    Route::resource('/nombre-marcas', NombreMarcaController::class)->middleware('can:nombre_equipos.index')->names('nombre_marcas');

    Route::resource('/nombre-modelos', NombreModeloController::class)->middleware('can:nombre_equipos.index')->names('nombre_modelos');

    Route::resource('/rol-equipos', RolEquipoController::class)->middleware('can:nombre_equipos.index')->names('rol_equipos');

    Route::resource('/departamentos', DepartamentoController::class)->middleware('can:nombre_equipos.index')->names('departamentos');

    Route::resource('/users', UserController::class)->only('index', 'edit', 'update', 'create')->middleware('can:users.index')->names('users');

    Route::resource('/roles', RoleController::class)->middleware('can:roles.index')->names('roles');
});
