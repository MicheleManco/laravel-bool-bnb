<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@home')->name('home');

Route::get('/search', 'GuestController@search')->name('search');

Route::get('/apartments/{id}', 'GuestController@showApartment')->name('showApartment');

Route::get('/logout', 'Auth\LoginController@logout') -> name('logout');
Route::post('/login', 'Auth\LoginController@login') -> name('login');
Route::post('/register', 'Auth\RegisterController@register') -> name('register');

// ->prefix('')
// Route::middleware('auth')->group(function () {
//     Route::get('/home', 'Controller@edit')->name('edit');
//     });