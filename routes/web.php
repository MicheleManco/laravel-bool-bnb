<?php

use Illuminate\Support\Facades\Route;

// homepage
Route::get('/', 'GuestController@home')->name('home');
// ricerca avanzata
Route::get('/search', 'GuestController@search')->name('search');

Route::get('/page/register', 'GuestController@pageRegister') -> name('pageRegister');
Route::get('/page/login', 'GuestController@pageLogin') -> name('pageLogin');

// rotte di registrazione, login e logout
Route::get('/logout', 'Auth\LoginController@logout') -> name('logout');
Route::post('/login', 'Auth\LoginController@login') -> name('login');
Route::post('/register', 'Auth\RegisterController@register') -> name('register');

// dashboard dell'utente
Route::get('/userDashboard', 'UserController@userDashboard')->name('userDashboard');

// dettaglio dell'appartamento
Route::get('/apartment/{id}', 'GuestController@showApartment')->name('showApartment');
// crea e salva un nuovo appartamento
Route::get('/create', 'UserController@apartmentCreate')->name('apartmentCreate');
Route::post('/store', 'UserController@apartmentStore')->name('apartmentStore');
// modifica e aggiorna i dati di un appartamento esistente
Route::get('/edit/{id}', 'UserController@apartmentEdit')->name('apartmentEdit');
Route::post('/update/{id}', 'UserController@apartmentUpdate')->name('apartmentUpdate');
// elimina un appartamento
Route::get('/delete/{id}', 'UserController@apartmentDelete')->name('apartmentDelete');

// --------------------------------------------------------------------------------------------

Route::get('api/apartments/list', 'ApiController@getApartments') -> name('api.apartments.list');
