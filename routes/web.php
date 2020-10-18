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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('rooms', 'RoomsController')->parameters(['rooms' => 'alias']);

Route::get('rooms/cat/{cat_alias?}', 'RoomsController@index')->name('roomsCat')->where('cat_alias', '[\w-]+');

Route::get('about', 'AboutController@index')->name('about');

Route::resource('news', 'BlogController')->parameters(['news'=>'alias']);
