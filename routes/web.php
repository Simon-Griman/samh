<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CintilloController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ExportarEquipoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MiEquipoController;
use App\Http\Controllers\NombreEquipoController;
use App\Http\Controllers\NombreMarcaController;
use App\Http\Controllers\NombreModeloController;
use App\Http\Controllers\NotaEntregaController;
use App\Http\Controllers\NotaSalidaController;
use App\Http\Controllers\NotaTrasladoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolEquipoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UbicacionController;
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
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/home', function () {
        return view('index');
    })->name('home');

    Route::get('/desincorporaciones', function () { return view('desincorporaciones.index'); })->name('desincorporaciones');

    Route::resource('/equipos', EquipoController::class)->middleware('can:equipos.index')->names('equipos');

    Route::resource('/inventario', InventarioController::class)->middleware('can:inventario.index')->names('inventario');

    Route::resource('/almacen', AlmacenController::class)->middleware('can:inventario.index')->names('almacen');

    Route::get('/mis-equipos', [MiEquipoController::class, 'index'])->middleware('can:mis_equipos')->name('mis_equipos');
    Route::get('/mis-equipos-pdf', [MiEquipoController::class, 'downloadEquipos'])->middleware('can:mis_equipos')->name('mis_equipos.pdf');

    Route::get('/exportar-equipos', [ExportarEquipoController::class, 'index'])->middleware('can:equipos.index')->name('exportar_equipos');

    Route::get('/exportar-equipos-pdf/{user_id?}/{departamento_id?}/{ubicacion_id?}/{f_adquisicion?}/{rol_id?}', [ExportarEquipoController::class, 'downloadEquipos'])->middleware('can:equipos.index')->name('exportar_equipos.pdf');

    Route::get('/entrega', [NotaEntregaController::class, 'index'])->middleware('can:equipos.index')->name('entrega');

    Route::get('/entrega-pdf/{selecciones}/{user_id}/{observacion?}', [NotaEntregaController::class, 'downloadEquipos'])->middleware('can:equipos.index')->name('entrega.pdf');

    Route::get('/salida', [NotaSalidaController::class, 'index'])->middleware('can:equipos.index')->name('salida');

    Route::get('/salida-pdf/{selecciones}/{user_id}/{observacion?}', [NotaSalidaController::class, 'downloadEquipos'])->middleware('can:equipos.index')->name('salida.pdf');

    Route::get('/traslado', [NotaTrasladoController::class, 'index'])->middleware('can:equipos.index')->name('traslado');

    Route::get('/traslado-pdf/{selecciones}/{user_id}/{origen}/{destino}', [NotaTrasladoController::class, 'downloadEquipos'])->middleware('can:equipos.index')->name('traslado.pdf');

    Route::get('/solicitar', [SolicitudController::class, 'solicitar'])->middleware('can:solicitar')->name('solicitar');

    Route::get('/solicitudes', [SolicitudController::class, 'solicitudes'])->middleware('can:solicitudes')->name('solicitudes');

    Route::get('/mis-solicitudes', [SolicitudController::class, 'misSolicitudes'])->middleware('can:solicitudes')->name('mis_solicitudes');

    Route::resource('/nombre-equipos', NombreEquipoController::class)->middleware('can:nombre_equipos.index')->names('nombre_equipos');

    Route::resource('/nombre-marcas', NombreMarcaController::class)->middleware('can:nombre_equipos.index')->names('nombre_marcas');

    Route::resource('/nombre-modelos', NombreModeloController::class)->middleware('can:nombre_equipos.index')->names('nombre_modelos');

    Route::resource('/rol-equipos', RolEquipoController::class)->middleware('can:nombre_equipos.index')->names('rol_equipos');

    Route::resource('/departamentos', DepartamentoController::class)->middleware('can:nombre_equipos.index')->names('departamentos');

    Route::resource('/ubicaciones', UbicacionController::class)->middleware('can:nombre_equipos.index')->names('ubicaciones');

    Route::resource('/proveedores', ProveedorController::class)->middleware('can:nombre_equipos.index')->names('proveedores');

    Route::get('/cargos', CargoController::class)->middleware('can:nombre_equipos.index')->name('cargos');

    Route::get('/articulos', ArticuloController::class)->middleware('can:nombre_equipos.index')->name('articulos');

    Route::resource('/users', UserController::class)->only('index', 'edit', 'update', 'create')->middleware('can:users.index')->names('users');

    Route::resource('/roles', RoleController::class)->middleware('can:roles.index')->names('roles');

    Route::get('/cintillos', CintilloController::class)->middleware('can:equipos.index')->name('cintillos');
});
