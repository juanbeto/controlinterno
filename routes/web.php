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

Route::post('/api/risks/impact','RisksImpactController@index');
Route::get('/api/risks/impact','RisksImpactController@index');
Route::get('/api/risks/impact/{id}','RisksImpactController@show');

Route::post('/api/risks/frecuency','RisksFrecuencyController@index');
Route::get('/api/risks/frecuency','RisksFrecuencyController@index');
Route::get('/api/risks/frecuency/{id}','RisksFrecuencyController@show');

Route::post('/api/risks/factortype','RisksFactorTypeController@index');
Route::get('/api/risks/factortype','RisksFactorTypeController@index');
Route::get('/api/risks/factortype/{id}','RisksFactorTypeController@show');

Route::resource('/api/risks/risks','RisksController');

Route::resource('/api/risks/actions','RisksActionController');
Route::get('/api/risks/actions/{id_risks}/risk','RisksActionController@indexRisks');

Route::resource('/api/risks/causeseffects','RisksCauseseffectsController');
Route::get('/api/risks/causeseffects/{id_risks}/risk','RisksCauseseffectsController@indexRisks');

Route::resource('/api/risks/impactrisks','RisksImpactRisksController');
Route::get('/api/risks/impactrisks/{id_risks}/risk','RisksImpactRisksController@indexRisks');

Route::resource('/api/risks/politics','RisksPoliticsController');
Route::get('/api/risks/politics/{id_risks}/risk','RisksPoliticsController@indexRisks');

Route::post('/api/risks/type','RisksTypeController@index');
Route::get('/api/risks/type','RisksTypeController@index');
Route::get('/api/risks/type/{id}','RisksTypeController@show');

Route::post('/api/risks/controltype','RisksControlTypeController@index');
Route::get('/api/risks/controltype','RisksControlTypeController@index');
Route::get('/api/risks/controltype/{id}','RisksControlTypeController@show');

Route::get('/clear-cache', function(){
	$code = Artisan::call('clear:cache');
});