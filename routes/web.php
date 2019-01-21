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

//***********************************************************************//
//***************List url's of the services of Risks********************//
//***********************************************************************//


Route::post('/api/risks/impact','RisksImpactController@index');
Route::get('/api/risks/impact','RisksImpactController@index');
Route::get('/api/risks/impact/{id}','RisksImpactController@show');

Route::post('/api/risks/frecuency','RisksFrecuencyController@index');
Route::get('/api/risks/frecuency','RisksFrecuencyController@index');
Route::get('/api/risks/frecuency/{id}','RisksFrecuencyController@show');

Route::post('/api/risks/factortype','RisksFactorTypeController@index');
Route::get('/api/risks/factortype','RisksFactorTypeController@index');
Route::get('/api/risks/factortype/{id}','RisksFactorTypeController@show');

Route::resource('/api/risks/risks','risks\RisksController');

Route::resource('/api/risks/actions','risks\RisksActionController');
Route::get('/api/risks/actions/{id_risks}/risk','risks\RisksActionController@indexRisks');

Route::resource('/api/risks/controls','risks\RisksControlController');
Route::get('/api/risks/actions/{id_risks}/risk','risks\RisksControlController@indexRisks');

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


Route::resource('/api/risks/factors','risks\RisksFactorController');

//***********************************************************************//
//***************List url's of the services of Audits********************//
//***********************************************************************//

Route::post('/api/audit/areas','audit\AuditAreasController@index');
Route::get('/api/audit/areas','audit\AuditAreasController@index');
Route::get('/api/audit/areas/{id}','audit\AuditAreasController@show');

Route::resource('/api/audit/activities','audit\AuditActivitiesController');
Route::get('/api/audit/activities/{id_audit}/audit','audit\AuditActivitiesController@indexAudit');

Route::resource('/api/audit/auditors','audit\AuditAuditorsController');
Route::get('/api/audit/auditors/{id_audit}/audit','audit\AuditAuditorsController@indexAudit');

Route::resource('/api/audit/auditorsactivities','audit\AuditAuditorsActivitiesController');
Route::get('/api/audit/auditorsactivities/{id_activitie}/activitie','audit\AuditAuditorsActivitiesController@indexActivitie');

Route::resource('/api/audit/audit','audit\AuditController');
Route::get('/api/audit/audit/{id_audit}/audit','audit\AuditController@indexAudit');
Route::post('/api/audit/audit/search','audit\AuditController@indexSearch');

Route::post('/api/audit/format','audit\AuditFormatController@index');
Route::post('/api/audit/format/search','audit\AuditFormatController@search');
Route::put('/api/audit/format/{id}','audit\AuditFormatController@update');
Route::get('/api/audit/format','audit\AuditFormatController@index');
Route::get('/api/audit/format/{id}','audit\AuditFormatController@show');

Route::resource('/api/audit/planning','audit\AuditPlanningController');
Route::get('/api/audit/planning/{id_audit}/audit','audit\AuditPlanningController@indexAudit');

Route::resource('/api/audit/program','audit\AuditProgramController');

Route::resource('/api/audit/question','audit\AuditQuestionController')->middleware('cors');


//Route::resource('/api/Admin/user','Admin\UserController');
Route::post('/api/Admin/user/login','Admin\UserController@login');


Route::get('/clear-cache', function(){
	$code = Artisan::call('clear:cache');
});