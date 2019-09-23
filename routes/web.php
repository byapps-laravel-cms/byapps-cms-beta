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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paylist', 'PaymentController@getIndex')->name('paylist');
Route::get('/paylist-data', 'PaymentController@getData')->name('paylist.data');


//AdvancedRoute::controller('paylist', 'PaymentController');
