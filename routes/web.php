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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HomeController@index')->name('home');
Route::get('/layout', 'HomeController@onLayoutChange');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::post('/chart', 'ChartController@index');
Route::get('/chart/app_daily', 'ChartController@onGetAppDailyChartData');
Route::get('/chart/app_total', 'ChartController@onGetAppChartData');

Route::view('/paylist', 'paylist')->name('paylist.view');
Route::get('/paylist/data', 'PaymentController@getPaymentData')->name('paylist');
Route::get('/paydetail/{idx}', 'PaymentController@getSingleData')->name('paydetail');

// 세션정보 확인용
Route::get('/session',function(){
    dd(session()->all());
});
