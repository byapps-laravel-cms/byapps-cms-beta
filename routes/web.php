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

// 세션정보 확인용
Route::get('/session',function(){
    dd(session()->all());
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/layout', 'HomeController@onLayoutChange');
Route::post('/search', 'HomeController@search')->name('search');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// 차트 데이터
Route::post('/chart', 'ChartController@index');
Route::get('/chart/app_daily', 'ChartController@onGetAppDailyChartData');
Route::get('/chart/app_total', 'ChartController@onGetAppChartData');

// 결제관리
Route::view('/paylist', 'paylist')->name('paylist.view');
Route::get('/paylist/data', 'PaymentController@getPaymentData')->name('paylist');
Route::get('/paydetail/{idx}', 'PaymentController@getSingleData')->name('paydetail');

// 프로모션
Route::view('/promolist', 'promolist')->name('promolist.view');
Route::get('/promolist/data', 'PromotionController@getPromotionData')->name('promolist');
Route::get('/promodetail/{idx}', 'PromotionController@getSingleData')->name('promodetail');

// 프로모션
Route::view('/appslist', 'appslist')->name('appslist.blade.php');
Route::get('/appslist/data', 'AppsListController@getAppsListData')->name('appslist');
Route::get('/appsdetaill/{idx}', 'AppsListController@getSingleData')->name('appsdetail');