<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Validated;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Routing\RouteGroup;

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
    return view('auth.login');
});
/*
Route::get('/empleado', function () {
    return view('empleado.index');
});

Route::get('/empleado/create', [EmpleadoController::class,'create']);
*/
// aqui buscamos todas las rutas de la clase empleadosController
Route::resource('empleado', EmpleadoController::class)->middleware('auth'); // seguridad de autenticacion

Auth::routes(['register'=>false , 'reset'=> false]);

Route::get('/home', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('home');

Route::middleware(['midleware' => 'auth'])->group(function () {

    Route::get('/', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('home');
});
