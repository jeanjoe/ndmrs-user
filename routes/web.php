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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@dashboard')->name('dashboard');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::get('/reports', 'HomeController@reports')->name('reports');
Route::resource('orders', 'OrderController');
Route::resource('patients', 'PatientController');
Route::get('/hospitals', 'HomeController@hospitals')->name('hospitals');

Route::resource('stock-cards', 'StockCardController');
Route::resource('stock-books', 'StockBookController');

Route::resource('stocks', 'StockController')->except(['create']);
Route::resource('health-facilities', 'HealthFacilityController')->except(['create', 'store', 'destroy', 'update', 'edit']);

Route::get('/users', 'AjaxController@ajaxUsers');
Route::post('/users', 'AjaxController@ajaxUsersSave');
Route::get('health_workers', 'HomeController@healthWorkers')->name('healthWorkers');
Route::get('health_facilities_under/{level}', 'HomeController@healthFacilitiesUnder')->name('healthFacilities.under');
