<?php
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@dashboard')->name('dashboard');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::get('/reports', 'HomeController@reports')->name('reports');
Route::resource('orders', 'OrderController');
Route::resource('patients', 'PatientController');
Route::get('/hospitals', 'HomeController@hospitals')->name('hospitals');
Route::resource('stock-cards', 'StockCardController');
Route::resource('stock_books', 'StockBookController');
Route::resource('stocks', 'StockController')->except(['create']);
Route::resource('health-facilities', 'HealthFacilityController')->except(['create', 'store', 'destroy', 'update', 'edit']);
Route::get('/users', 'AjaxController@ajaxUsers');
Route::post('/users', 'AjaxController@ajaxUsersSave');
Route::get('health_workers', 'HomeController@healthWorkers')->name('healthWorkers');
Route::get('health_facilities_under/{level}', 'HomeController@healthFacilitiesUnder')->name('healthFacilities.under');
Route::resource('health_facilities_below','HealthFacilityBelowController');
