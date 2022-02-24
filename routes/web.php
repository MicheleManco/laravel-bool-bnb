<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@home')->name('home');

// ->prefix('')
// Route::middleware('auth')->group(function () {
//     Route::get('/home', 'Controller@edit')->name('edit');
//     });