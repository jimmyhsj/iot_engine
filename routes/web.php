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

// Auth::routes();

Route::auth();

Route::get('/', function () {
	return VIEW('welcome');
});

Route::get('/logout',function(){
	Auth::logout();
	return redirect('/');
});

Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
Route::get('/dashboard/google', 'DashboardController@googleChartReport')->middleware('auth');
Route::get('/iotconnect', 'DashboardController@iotconnect')->middleware('auth');


// AWS Realted
Route::get('/loadDyno', 'DynamoDbUtilController@loadDyno')->middleware('auth');

Route::get('/home', 'HomeController@index');
