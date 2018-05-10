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

Route::resource('login', 'Auth.LoginController');
Route::resource('hoteles', 'HotelController');
Route::resource('comentarios', 'ComentarioController');
Auth::routes();

Route::get('/home', 'HotelController@index')->name('hoteles');

