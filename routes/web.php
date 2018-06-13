<?php
Auth::routes();
Route::get('/', 'HomeController@dashboard')->name('dashboard');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::get('/reports', 'HomeController@reports')->name('reports');
Route::resource('orders', 'OrderController')->only(['index', 'store', 'show']);
Route::resource('departments', 'DepartmentController');
Route::get('/hospitals', 'HomeController@hospitals')->name('hospitals');
Route::resource('stock-cards', 'StockCardController');
Route::resource('stock-books', 'StockBookController');
Route::resource('stocks', 'StockController')->except(['create']);
Route::resource('health-facilities', 'HealthFacilityController')->except(['create', 'store', 'destroy', 'update', 'edit']);
Route::get('/users', 'AjaxController@ajaxUsers');
Route::post('/users', 'AjaxController@ajaxUsersSave');
Route::resource('health-workers', 'HealthWorkerController')->only(['index', 'create', 'store', 'destroy']);
Route::get('health_facilities_under/{level}', 'HomeController@healthFacilitiesUnder')->name('healthFacilities.under');
Route::resource('health_facilities_below','HealthFacilityBelowController');

Route::get('department/reports/all', 'HomeController@allDepartmentReport')->name('department.report.all');
Route::get('department/report', 'HomeController@departmentReport')->name('department.report');
Route::post('department/report', 'HomeController@departmentStoreReport')->name('department.report.store');
Route::resource('order-lists', 'OrderListController');
Route::get('cycles', 'HomeController@cycles')->name('cycles');
Route::get('cycles/{id}/order', 'HomeController@cycleOrder')->name('cycles.order.show');
Route::get('cycles/{id}/order/create', 'HomeController@cycleOrderCreate')->name('cycles.order.create');
Route::post('cycles/{id}/order/create', 'HomeController@saveCycleOrderCreate')->name('cycles.order.save');
