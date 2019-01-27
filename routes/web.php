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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');
Route::get('/profile', 'UserController@show')->name('profile');
Route::post('/profile', 'UserController@update')->name('profile.update');

Route::group(['middleware' => ['admin']], function () {
  Route::get('/users', 'UserController@list')->name('admin.users');
  Route::get('/users/{id}/edit', 'UserController@edit');
  Route::put('/users/change/password', 'UserController@changePassword');
  Route::get('/recruitments', 'SeleksiController@index')->name('admin.seleksi.index');
  Route::post('/recruitments/verification', 'SeleksiController@verifikasi')->name('admin.seleksi.verifikasi');
  Route::post('/recruitments/setLulus', 'SeleksiController@setLulus')->name('admin.seleksi.set');
  Route::post('/users/change/level/super', 'UserController@setSuperAdmin')->name('admin.set.super');
  Route::post('/users/change/level/admin', 'UserController@setAdmin')->name('admin.set.admin');
  Route::delete('/users/delete', 'UserController@delete')->name('admin.users.delete');
  Route::get('/settings', 'SeleksiController@setting')->name('admin.setting');
  Route::post('/settings', 'SeleksiController@updateSettings')->name('admin.setting.update');
  Route::post('/settings-timeline', 'SeleksiController@updateSettingsTimeline')->name('admin.setting.update.timeline');
  Route::post('/settings-firstmeet', 'SeleksiController@updateSettingsFirstMeet')->name('admin.setting.update.firstmeet');
});

Route::group(['middleware' => 'peserta'], function () {
  Route::post('/peminatan', 'SeleksiController@store')->name('seleksi.store');
  Route::get('/recruitment', 'SeleksiController@index')->name('seleksi.index');
  Route::post('/berkas', 'SeleksiController@upload')->name('seleksi.upload');
  Route::get('/result', 'SeleksiController@pengumuman')->name('seleksi.pengumuman');
});
