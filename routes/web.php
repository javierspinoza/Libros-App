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

Route::group(['middleware'=>['guest']],function(){//usuarios no autenticados
        Route::get('/','Auth\LoginController@showLoginForm');
        Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){ //usuarios autenticados

        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');//cerrar seccion

        Route::get('/main', function () {
                return view('contenido/contenido');
        })->name('main');

        Route::group(['middleware' => ['Registrador']], function () {
        
        Route::get('libro','LibroController@index');
        Route::get('selectEditorial','EditorialController@getEditoriales');
        Route::get('selectCategoria','CategoriaController@getCategorias');
        Route::get('selectAutor','AutorController@getAutores');
        Route::get('selectIdioma','IdiomaController@getIdiomas');
        Route::post('libro/registrar','LibroController@store');
        Route::put('libro/actualizar','LibroController@update');
        Route::post('libro/eliminar','LibroController@destroy');

        Route::get('solicitud','Solicitud_librosController@index');
        Route::get('getlibro','LibroController@getlibros');
        Route::post('solicitud/registrar','Solicitud_librosController@store');
        // Route::post('solicitud/eliminar','Solicitud_librosController@destroy');
        });

        Route::group(['middleware' => ['Administrador']], function () {

                Route::get('categoria','CategoriaController@index');
                Route::post('categoria/registrar','CategoriaController@store');
                Route::put('categoria/actualizar','CategoriaController@update');
                Route::post('categoria/eliminar','CategoriaController@destroy');
                
                Route::get('editorial','EditorialController@index');
                Route::post('editorial/registrar','EditorialController@store');
                Route::put('editorial/actualizar','EditorialController@update');
                Route::post('editorial/eliminar','EditorialController@destroy');
                
                Route::get('idioma','IdiomaController@index');
                Route::post('idioma/registrar','IdiomaController@store');
                Route::put('idioma/actualizar','IdiomaController@update');
                Route::post('idioma/eliminar','IdiomaController@destroy');
                
                Route::get('pais','PaisController@index');
                Route::post('pais/registrar','PaisController@store');
                Route::put('pais/actualizar','PaisController@update');
                Route::post('pais/eliminar','PaisController@destroy');
                
                // Route::get('autor','AutorController@index');
                // Route::post('autor/registrar','AutorController@store');
                // Route::post('autor/eliminar','AutorController@destroy');
                
                Route::get('autor','AutorController@index');
                Route::get('selectPais','PaisController@getPais');
                Route::post('autor/registrar','AutorController@store');
                Route::put('autor/actualizar','AutorController@update');
                Route::post('autor/eliminar','AutorController@destroy');
                
                
                
                Route::get('persona','PersonaController@index');
                Route::get('selectPersona','PersonaController@getPersona');
                Route::post('persona/registrar','PersonaController@store');
                Route::put('persona/actualizar','PersonaController@update');
                Route::post('persona/eliminar','PersonaController@destroy');
        
                Route::get('/rol','RolController@index');
                Route::get('/rol/selectRol', 'RolController@selectRol');
        
                Route::get('/user', 'UserController@index');
                Route::post('/user/registrar', 'UserController@store');
                Route::put('/user/actualizar', 'UserController@update');
                Route::put('/user/desactivar', 'UserController@desactivar');
                Route::put('/user/activar', 'UserController@activar');

                Route::get('libro','LibroController@index');
                Route::get('selectEditorial','EditorialController@getEditoriales');
                Route::get('selectCategoria','CategoriaController@getCategorias');
                Route::get('selectAutor','AutorController@getAutores');
                Route::get('selectIdioma','IdiomaController@getIdiomas');
                Route::post('libro/registrar','LibroController@store');
                Route::put('libro/actualizar','LibroController@update');
                Route::post('libro/eliminar','LibroController@destroy');
        
                Route::get('solicitud','Solicitud_librosController@index');
                Route::get('getlibro','LibroController@getlibros');
                Route::post('solicitud/registrar','Solicitud_librosController@store');
                // Route::post('solicitud/eliminar','Solicitud_librosController@destroy');
                
                Route::get('detsolicitud','Det_solicitudesController@index');
        });
        
});


// Route::get('/home', 'HomeController@index')->name('home');
