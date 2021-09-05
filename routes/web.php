<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecetaController;

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

Route::get('/', 'InicioController@index')->name('inicio.index');
Route::get('/recetas', 'RecetaController@index')->name('recetas.index');
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
Route::get('/recetas/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
Route::get('/recetas/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
Route::put('/recetas/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
Route::delete('/recetas/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');

Route::get('/categoria/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');

// Buscador
Route::get('/buscar', 'RecetaController@search')->name('buscar.show');

// Route::resource('recetas', 'RecetaController');

Route::get('/perfiles/{perfil}', [PerfilController::class, 'show'])->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', [PerfilController::class, 'edit'])->name('perfiles.edit');
Route::put('/perfiles/{perfil}', [PerfilController::class, 'update'])->name('perfiles.update');


// Almacena los likes de las recetas
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
