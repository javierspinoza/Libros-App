<?php

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
// ::::::::::::::
// 1. creo las rutas
// Route::get('/', function () {
//     return view('principal');
// });
Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('categoria','CategoriaController@index');

Route::get('editorial','EditorialController@index');

Route::get('idioma','IdiomaController@index');

Route::get('pais','PaisController@index');

Route::get('autor','AutorController@index');