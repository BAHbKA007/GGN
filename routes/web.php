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

Route::get('/soap', 'SoapController');

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index');
Route::get('/aktivieren', 'AktivierenController');

Route::get('/artikel', 'ArtikelController@index');
Route::post('/artikel', 'ArtikelController@store');
Route::get('/artikel/{id}/edit', 'ArtikelController@edit');
Route::put('/artikel/{id}', 'ArtikelController@update');
Route::delete('/artikel', 'ArtikelController@destroy');

Route::get('/benutzer', 'BenutzerController@index');
Route::post('/benutzer', 'BenutzerController@store');
Route::get('/benutzer/{id}/edit', 'BenutzerController@edit');
Route::put('/benutzer/{id}', 'BenutzerController@update');
Route::delete('/benutzer/{id}', 'BenutzerController@destroy');

Route::get('/kunden', 'KundeController@index');
Route::post('/kunden', 'KundeController@store');
Route::get('/kunden/{id}/edit', 'KundeController@edit');
Route::put('/kunden/{id}', 'KundeController@update');
Route::delete('/kunden/{id}', 'KundeController@destroy');

Route::get('/ggn', 'GgnController@index');
Route::get('/ggn/{id}/edit', 'GgnController@edit');
Route::post('/ggn', 'GgnController@store');
Route::post('/ggn/del', 'GgnController@destroy');

Route::get('/programm', 'ProgrammController@index');
Route::get('/programm/create', 'ProgrammController@create');
Route::post('/programm', 'ProgrammController@store');
Route::get('/programm/{id}/edit', 'ProgrammController@edit');
Route::get('/programm/{id}', 'ProgrammController@show');
Route::put('/programm/{id}', 'ProgrammController@update');

Route::post('/programmkunde', 'ProgrammkundeController@store');
Route::delete('/programmkunde/{id}', 'ProgrammkundeController@destroy');

Route::get('/programm/{pro_id}/{id}', 'ProgrammkundeartikelController@show');
Route::post('/programmkundeartikel', 'ProgrammkundeartikelController@store');
Route::delete('/programmkundeartikel/{id}', 'ProgrammkundeartikelController@destroy');

Route::get('/artikel/{art_id}/ggn/', 'ggnsartikelController@index');
Route::post('/artikel/{art_id}/ggn', 'ggnsartikelController@store');

Route::get('/zaehlung', 'ZaehlungController@index');
Route::post('/zaehlung/neu', 'ZaehlungController@store');
Route::get('/zaehlung/{id}', 'ZaehlungController@show');

Route::get('/zaehlung/{zaehlung}/kunde/{kunde}', 'ZaehlungpositionController@index');
Route::get('/zaehlung/{zaehlung}/kunde/{kunde}/artikel/{artikel}', 'ZaehlungpositionController@show');
Route::post('/zaehlung/artikel', 'ZaehlungpositionController@store');
Route::delete('/zaehlposition/{id}', 'ZaehlungpositionController@destroy');

Route::post('/comment', 'CommentController@store');

Route::get('/sync', 'Synch');

