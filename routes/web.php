<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@home')->name('home');

Route::get('/search', 'GuestController@search')->name('search');

Route::get('/apartments/{id}', 'GuestController@showApartment')->name('showApartment');

Route::get('/logout', 'Auth\LoginController@logout') -> name('logout');
Route::post('/login', 'Auth\LoginController@login') -> name('login');
Route::post('/register', 'Auth\RegisterController@register') -> name('register');

Route::get('/userDashboard', 'UserController@userDashboard')->name('userDashboard');

Route::get('/create', 'UserController@apartmentCreate')->name('apartmentCreate');
Route::post('/store', 'UserController@apartmentStore')->name('apartmentStore');

// ->prefix('')
// Route::middleware('auth')->group(function () {
//     Route::get('/home', 'Controller@edit')->name('edit');
//     });