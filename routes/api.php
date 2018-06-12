<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('health_workers', 'AjaxController@ajaxUsers');
Route::get('drug/{id}', 'AjaxController@showDrug');
Route::get('drugs', 'API\AjaxController@getDrugs');
Route::get('get/issued-drug/{id}', 'API\AjaxController@getIssuedDrug');

Route::post('recieive-drug/{id}', 'API\AjaxController@receiveDrug');
Route::post('issue-drug/{id}', 'API\AjaxController@issueDrug');

Route::post('products','AjaxController@saveProduct');
Route::post('issued_stocks','AjaxController2@saveProduct');
