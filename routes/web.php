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

Route::get('/', function () {
    return view('index');
});

Route::get('alumnos/{alumno}/fmatricula', 'AlumnoController@fmatricula')->name('alumnos.fmatricula');
Route::get('alumnos/{alumno}/fcalificar', 'AlumnoController@fcalificar')->name('alumnos.fcalificar');
//creamos los recursos
Route::resource('alumnos','AlumnoController');
Route::resource('modulos', 'ModuloController');
//las rutas POST se ponen al final
Route::post('alumnos1','AlumnoController@matricular')->name('alumnos.matricular');
//cambio la ruto a alumnos1 porque me sobre escribe el ultimo post
Route::post('alumnos2','AlumnoController@calificar')->name('alumnos.calificar');
