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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');
Route::get('/profile', 'UserController@show')->name('profile');
Route::post('/profile', 'UserController@update')->name('profile.update');

Route::post('/peminatan', 'SeleksiController@store')->name('seleksi.store');
Route::get('/attachment', 'SeleksiController@index')->name('seleksi.index');
Route::post('/berkas', 'SeleksiController@upload')->name('seleksi.upload');
