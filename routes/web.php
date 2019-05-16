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

Route::get('/', 'HomeController@index');

Route::get('/grades', 'Api\ApiController@getGrades')->middleware('ajax')->name('get-grades');
Route::get('/car-info', 'Api\ApiController@getCarInfo')->middleware('ajax')->name('get-car-info');
Route::post('/send-email', 'Api\ApiController@sendEmail')->middleware('ajax')->name('send-email');
