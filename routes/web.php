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

Route::get('/','UserController@login');
Route::post('/login','UserController@signin');
Route::get('/register','UserController@register');
Route::get('/logout','UserController@logout');
Route::post('/signup','UserController@signup');
Route::get('/carinasabah','UserController@cariNasabah');
Route::get('/cariadmin','UserController@cariAdmin');
Route::get('/dashboard','UserController@dashboard');


Route::resource('admin','AdminController');
Route::resource('anggota','AnggotaController');
Route::resource('jenis', 'JtransaksiController');
Route::resource('bungaSimpanan', 'BungaController');
Route::resource('simpanan', 'SimpanController');

Route::get('/login/1', 'SimpanController@index');
Route::get('/showMember', 'SimpanController@showMember');
Route::get('/simpanan/Show', 'SimpanController@show');
Route::get('/cariSimpanan', 'SimpanController@cari');
Route::get('/simpanan/{id}/create', 'SimpanController@create');
Route::put('/simpanan/{id}/store', 'SimpanController@store');


route::get('/reportHarian', 'ReportController@harian');
route::get('/reportMingguan', 'ReportController@mingguan');
route::get('/reportBulanan', 'ReportController@bulanan');
route::get('/reportTahunan', 'ReportController@tahunan');


