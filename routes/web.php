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

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/aktivieren', 'AktivierenController');

Route::get('/artikel', 'ArtikelController@index');
Route::post('/artikel', 'ArtikelController@store');
Route::get('/artikel/{id}/edit', 'ArtikelController@edit');
Route::put('/artikel/{id}', 'ArtikelController@update');
Route::delete('/artikel', 'ArtikelController@destroy');

Route::get('/kiste', 'KisteController@index');
Route::post('/kiste', 'KisteController@store');
Route::get('/kiste/{id}/edit', 'KisteController@edit');
Route::put('/kiste/{id}', 'KisteController@update');
Route::delete('/kiste', 'KisteController@destroy');

Route::get('/benutzer', 'BenutzerController@index');
Route::post('/benutzer', 'BenutzerController@store');
Route::get('/benutzer/{id}/edit', 'BenutzerController@edit');
Route::put('/benutzer/{id}', 'BenutzerController@update');
Route::delete('/benutzer', 'BenutzerController@destroy');

Route::get('/kunden', 'KundeController@index');
Route::post('/kunden', 'KundeController@store');
Route::get('/kunden/{id}/edit', 'KundeController@edit');
Route::put('/kunden/{id}', 'KundeController@update');
Route::delete('/kunden', 'KundeController@destroy');

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

Route::get('/programm_artikel/{id}', 'ProgrammController@programm_artikel');
Route::get('/programm_artikel/{programm}/artikel/{artikel}', 'ProgrammController@programm_artikel_kunde');
Route::post('/programm_artikel/artikel/store', 'ProgrammController@programm_artikel_kunde_store');

Route::post('/programmkunde', 'ProgrammkundeController@store');
Route::delete('/programmkunde', 'ProgrammkundeController@destroy');

Route::get('/programm/{pro_id}/{id}', 'ProgrammkundeartikelController@show');
Route::post('/programmkundeartikel', 'ProgrammkundeartikelController@store');
Route::delete('/programmkundeartikel', 'ProgrammkundeartikelController@destroy');

Route::get('/artikel/{art_id}/ggn/', 'ggnsartikelController@index');
Route::post('/artikel/{art_id}/ggn', 'ggnsartikelController@store');
Route::delete('/artikel/ggn', 'ggnsartikelController@destroy');

Route::get('/zaehlung', 'ZaehlungController@index');
Route::post('/zaehlung/neu', 'ZaehlungController@store');
Route::post('/zaehlung/neu_vorbelegt', 'ZaehlungController@store_vorbelegt');
Route::get('/zaehlung/{id}', 'ZaehlungController@show');
Route::get('/zaehlung/info/{id}', 'ZaehlungController@info');

Route::get('/zaehlung/{zaehlung}/kunde/{kunde}', 'ZaehlungpositionController@index');
Route::get('/zaehlung/{zaehlung}/kunde/{kunde}/artikel/{artikel}', 'ZaehlungpositionController@show');
Route::post('/zaehlung/artikel', 'ZaehlungpositionController@store');
Route::post('/zaehlposition', 'ZaehlungpositionController@update');
Route::delete('/zaehlposition', 'ZaehlungpositionController@destroy');

Route::post('/comment', 'CommentController@store');

//Route::get('/sync', 'Synch');
Route::post('/soap/python/import', 'SoapPythonImport');

Route::get('/export/{id}', 'ZaehlungController@export')->name('export');
Route::get('/kistenexport/{id}', 'ZaehlungController@kistenexport')->name('kistenexport');

Route::get('/comment/{id}', 'CommentController@index');
Route::post('/comment/erledigen', 'CommentController@erledigen');

Route::get('/suche', 'SucheController@suche');
Route::post('/suche', 'SucheController@suchrgebnis');

Route::get('/python/check', 'PythonController@check');

Route::get('419', 'ErrorController@Error419');

Route::get('500', 'ErrorController@Error500');

Route::get('/bestand', 'BestandController@index');
Route::get('/show_bestand', 'BestandController@show');