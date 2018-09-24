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

Route::post('/api/impact','RisksImpactController@index');
Route::get('/api/impact','RisksImpactController@index');

Route::post('/api/frecuency','RisksFrecuencyController@index');
Route::get('/api/frecuency','RisksFrecuencyController@index');


Route::post('/api/impact/r','RisksImpactController@register');
