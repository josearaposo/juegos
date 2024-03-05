<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\Desarrolladora as ControllersDesarrolladora;
use App\Http\Controllers\DesarrolladoraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideojuegoController;
use App\Livewire\Busqueda;
use App\Models\Desarrolladora;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/videojuegos/poseo', [VideojuegoController::class, 'poseo'])
->middleware('auth');

Route::resource('/videojuegos', VideojuegoController::class)
->middleware('auth');

Route::resource('/desarrolladoras', DesarrolladoraController::class)
->middleware('auth');

Route::get('/cambiarImagDes/{desarrolladora}', [DesarrolladoraController::class, 'cambiar_imagen'])
    ->name('desarrolladora.cambiar_imagen')->whereNumber('desarrolladora');

Route::post('/cambiarImagDes/{desarrolladora}', [DesarrolladoraController::class, 'guardar_imagen'])
->name('desarrolladora.guardar_imagen')->whereNumber('desarrolladora');

Route::get('/cambiar_imagen/{videojuego}', [VideojuegoController::class, 'cambiar_imagen'])
    ->name('videojuegos.cambiar_imagen')->whereNumber('videojuego');

Route::post('/cambiar_imagen/{videojuego}', [VideojuegoController::class, 'guardar_imagen'])
->name('videojuegos.guardar_imagen')->whereNumber('videojuego');

Route::get('/comentarios/create/{comentable}/{tipo}/{videojuego}', [ComentarioController::class, 'create'])
->name('hacer_comentario');

Route::post('/comentarios/store/{comentable}/{tipo}/{videojuego}', [ComentarioController::class, 'store'])
->name('guardar_comentario');


require __DIR__.'/auth.php';
