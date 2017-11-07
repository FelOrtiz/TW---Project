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

Auth::routes();

Route::get('/home/{user}', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

/*
GET 	index 	-> retorna vista para mostrar todos los registros
GET 	create 	-> retorna vista para registrar
POST 	store 	-> metodo que almacena en la base de datos
GET 	edit 	-> retorna vista para editar
POST 	update 	-> método que actualiza y luego almacena en la base de datos
POST 	delete 	-> método que elimina un registro de la base de datos
*/

//Institution
Route::get('institution/index', 'InstitutionController@index');
Route::get('institution/create', 'InstitutionController@create');
Route::post('institution', 'InstitutionController@store'); 

//Enclosure
Route::get('enclosure/index', 'EnclosureController@index');
Route::get('enclosure/create','EnclosureController@create');
Route::post('enclosure', 'EnclosureController@store'); 
Route::get('enclosure/{enclosure}/edit' ,'EnclosureController@edit');
Route::post('enclosure/update/{enclosure}', 'EnclosureController@update');
Route::get('enclosure/{enclosure}','EnclosureController@destroy');

//Gametype
Route::get('gametype/index', 'GametypeController@index');
Route::get('gametype/create', 'GametypeController@create');
Route::post('gametype', 'GametypeController@store');
Route::get('gametype/{gametype}/edit', 'GametypeController@edit');
Route::post('gametype/update/{gametype}', 'GametypeController@update');
Route::get('gametype/{gametype}', 'GametypeController@destroy');

//Solicitation
Route::get('solicitation/index', 'SolicitationController@index');
Route::get('solicitation/{solicitation}', 'SolicitationController@destroy');