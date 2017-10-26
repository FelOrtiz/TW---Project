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

Route::get('/home', 'HomeController@index')->name('home');
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
Route::get('institution/{institution}/edit', 'InstitutionController@edit');
Route::post('institution/update/{institution}', 'InstitutionController@update');
Route::post('institution/delete/{institution}','InstitutionController@delete');

//Enclosure
Route::get('enclosure/index', 'EnclosureController@index');
Route::get('enclosure/create','EnclosureController@create');
Route::post('enclosure', 'EnclosureController@store'); 
Route::get('enclosure/{enclosure}/edit' ,'EnclosureController@edit');
Route::post('enclosure/update/{enclosure}', 'EnclosureController@update');
Route::post('enclosure/delete/{enclosure}','EnclosureController@delete');

//Field
Route::get('field/index', 'FieldController@index');
Route::get('field/create', 'FieldController@create');
Route::post('field', 'FieldController@store');
Route::get('field/{field}/edit', 'FieldController@edit');
Route::post('field/update/{field}', 'FieldController@update');
Route::post('field/delete/{field}', 'FieldController@delete');


//FieldType
Route::get('fieldtype/index', 'FieldTypeController@index');
Route::get('fieldtype/create','FieldTypeController@create');
Route::post('fieldtype', 'FieldTypeController@store'); 
Route::get('fieldtype/{fieldtype}/edit' ,'FieldTypeController@edit');
Route::post('fieldtype/update/{fieldtype}', 'FieldTypeController@update');
Route::post('fieldtype/delete/{fieldtype}','FieldTypeController@delete');
