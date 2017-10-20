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

Route::get('/tour','TourController@index')->name('tour');
Route::get('/tour/edit/{id}','TourController@edit')->name('tour.edit');
Route::get('/tour/create','TourController@create')->name('tour.create');
Route::post('/tour/save','TourController@save')->name('tour.save');
Route::post('/tour/add','TourController@add')->name('tour.add');

Route::get('/booking','BookingController@index')->name('booking');
Route::get('/booking/create/{t_id}','BookingController@create')->name('booking.create');
Route::post('/booking/add','BookingController@add')->name('booking.add');
Route::get('/booking/edit/{id}','BookingController@edit')->name('booking.edit');
Route::post('/booking/save','BookingController@save')->name('booking.save');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
