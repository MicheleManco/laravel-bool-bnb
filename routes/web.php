<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@home')->name('home');

Route::get('/search', 'GuestController@search')->name('search');

Route::get('/apartment/{id}', 'GuestController@showApartment')->name('showApartment');

Route::get('/logout', 'Auth\LoginController@logout') -> name('logout');
Route::post('/login', 'Auth\LoginController@login') -> name('login');
Route::post('/register', 'Auth\RegisterController@register') -> name('register');

Route::get('/userDashboard', 'UserController@userDashboard')->name('userDashboard');

Route::get('/create', 'UserController@apartmentCreate')->name('apartmentCreate');
Route::post('/store', 'UserController@apartmentStore')->name('apartmentStore');

Route::get('/edit/{id}', 'UserController@apartmentEdit')->name('apartmentEdit');
Route::post('/update/{id}', 'UserController@apartmentUpdate')->name('apartmentUpdate');

Route::get('/delete/{id}', 'UserController@apartmentDelete')->name('apartmentDelete');
// ->prefix('')
// Route::middleware('auth')->group(function () {
//     Route::get('/home', 'Controller@edit')->name('edit');
//     });