<?php

use Illuminate\Support\Facades\Route;


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



Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');


Route::get('/', function () {
    return view('Main');
})->name('home')->middleware('auth');

Route::get('Main','HomeController@index')->name('home')->middleware('auth');

Route::post('/login', 'Auth\LoginController@login')->name('login');






Route::get('logout', 'Auth\LoginController@logout')->name('logout');
