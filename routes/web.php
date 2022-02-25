<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@home')->name('home');

Route::get('/search', 'GuestController@search')->name('search');

Route::get('/apartments/{id}', 'GuestController@showApartment')->name('showApartment');

// ->prefix('')
// Route::middleware('auth')->group(function () {
//     Route::get('/home', 'Controller@edit')->name('edit');
//     });