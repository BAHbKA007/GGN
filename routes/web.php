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

Route::get('/', 'HomeController@index')->middleware('checkrole');
Route::get('/aktivieren', 'AktivierenController');

Route::get('/artikel', 'ArtikelController@index')->middleware('checkrole');
Route::post('/artikel', 'ArtikelController@store')->middleware('checkrole');
Route::get('/artikel/{id}/edit', 'ArtikelController@edit')->middleware('checkrole');
Route::put('/artikel/{id}', 'ArtikelController@update')->middleware('checkrole');
Route::delete('/artikel/{id}', 'ArtikelController@destroy')->middleware('checkrole');

Route::get('/benutzer', 'BenutzerController@index')->middleware('checkrole');
Route::post('/benutzer', 'BenutzerController@store')->middleware('checkrole');
Route::get('/benutzer/{id}/edit', 'BenutzerController@edit')->middleware('checkrole');
Route::put('/benutzer/{id}', 'BenutzerController@update')->middleware('checkrole');
Route::delete('/benutzer/{id}', 'BenutzerController@destroy')->middleware('checkrole');

Route::get('/kunden', 'KundeController@index')->middleware('checkrole');
Route::post('/kunden', 'KundeController@store')->middleware('checkrole');
Route::get('/kunden/{id}/edit', 'KundeController@edit')->middleware('checkrole');
Route::put('/kunden/{id}', 'KundeController@update')->middleware('checkrole');
Route::delete('/kunden/{id}', 'KundeController@destroy')->middleware('checkrole');

Route::get('/ggn', 'GgnController@index')->middleware('checkrole');
Route::get('/ggn/{id}/edit', 'GgnController@edit')->middleware('checkrole');
Route::put('/ggn/{id}', 'GgnController@update')->middleware('checkrole');
Route::post('/ggn', 'GgnController@store')->middleware('checkrole');
Route::delete('/ggn/{id}', 'GgnController@destroy')->middleware('checkrole');

Route::get('/programm', 'ProgrammController@index')->middleware('checkrole');
Route::get('/programm/create', 'ProgrammController@create')->middleware('checkrole');
Route::post('/programm', 'ProgrammController@store')->middleware('checkrole');
Route::get('/programm/{id}/edit', 'ProgrammController@edit')->middleware('checkrole');
Route::get('/programm/{id}', 'ProgrammController@show')->middleware('checkrole');
Route::put('/programm/{id}', 'ProgrammController@update')->middleware('checkrole');

Route::post('/programmkunde', 'ProgrammkundeController@store')->middleware('checkrole');
Route::delete('/programmkunde/{id}', 'ProgrammkundeController@destroy')->middleware('checkrole');

Route::get('/programm/{pro_id}/{id}', 'ProgrammkundeartikelController@show')->middleware('checkrole');
Route::post('/programmkundeartikel', 'ProgrammkundeartikelController@store')->middleware('checkrole');
Route::delete('/programmkundeartikel/{id}', 'ProgrammkundeartikelController@destroy')->middleware('checkrole');

Route::get('/artikel/{art_id}/ggn/', 'ggnsartikelController@index')->middleware('checkrole');
Route::post('/artikel/{art_id}/ggn', 'ggnsartikelController@store')->middleware('checkrole');

Route::get('/zaehlung', 'ZaehlungController@index')->middleware('checkrole');
Route::post('/zaehlung/neu', 'ZaehlungController@store')->middleware('checkrole');
Route::get('/zaehlung/{id}', 'ZaehlungController@show')->middleware('checkrole');

Route::get('/zaehlung/{zaehlung}/kunde/{kunde}', 'ZaehlungpositionController@index')->middleware('checkrole');
Route::get('/zaehlung/{zaehlung}/kunde/{kunde}/artikel/{artikel}', 'ZaehlungpositionController@show')->middleware('checkrole');
Route::post('/zaehlung/artikel', 'ZaehlungpositionController@store')->middleware('checkrole');