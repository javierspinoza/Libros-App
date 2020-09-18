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
Route::get('/', function () {
    return view('principal');
});
Route::get('/', function () {
    return view('contenido/categoria');
});
Route::get('/editorial', function () {
    return view('contenido/editorial');
});
Route::get('/idioma', function () {
    return view('contenido/idioma');
});
Route::get('/pais', function () {
    return view('contenido/pais');
});
route::get('plantilla', function () {
    return view('plantilla');
});


