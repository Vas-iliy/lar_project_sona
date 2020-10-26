<?php

use Illuminate\Support\Facades\Auth;
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

Route::post('rooms/search', 'RoomsController@search')->name('search');
Route::post('rooms/reservation/{alias}', 'RoomsController@reservation')->name('reserv');
Route::post('rooms/comment', 'RoomsController@comment')->name('comment');
Route::resource('rooms', 'RoomsController')->parameters(['rooms' => 'alias'])->only(['index', 'show']);

Route::get('rooms/cat/{cat_alias?}', 'RoomsController@index')->name('roomsCat')->where('cat_alias', '[\w-]+');

Route::get('about', 'AboutController@index')->name('about');

Route::resource('news', 'BlogController')->parameters(['news'=>'alias']);

Route::get('contact', 'ContactController@index')->name('contact');

Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@register')->name('registerUser');
Route::get('/login', 'RegisterController@login')->name('login');
Route::post('/login', 'RegisterController@auth')->name('auth');
Route::get('/logout', 'RegisterController@logout')->name('logout');

Route::resource('users', 'UsersController')->only(['show', 'edit', 'update']);

Route::middleware('auth')->prefix('/admin')->group(function () {
    Route::get('/', 'Admin\IndexController@index')->name('homeAdmin');
    Route::resource('room', 'Admin\RoomController');
});
