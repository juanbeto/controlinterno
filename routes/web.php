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


Route::resource('/api/risks/probabilityDetail','RiskProbabilityCalificationControllerDetail');
Route::get('/api/risks/probabilityPromedio','RiskProbabilityCalificationControllerDetail@promedio');
Route::resource('/api/risks/probability','RiskProbabilityCalificationController');


Route::get('/api/risks/calificationUsuarios','riskFactorCalificationController@usuarios');
Route::get('/api/risks/valores','riskFactorCalificationDetailController@califications');
Route::resource('/api/risks/calification','riskFactorCalificationController');
Route::get('/api/risks/calification/avg/{id}','riskFactorCalificationDetailController@getAvgByFactor');

Route::resource('/api/risks/riskeffects','RiskEffectsController');
Route::get('/api/risks/riskeffects/{id}','RiskEffectsCauseController@show');


Route::resource('/api/risks/riskecauses','RiskEffectsCauseController');
Route::get('/api/risks/riskecauses/{id}','RiskEffectsCauseController@show');

Route::resource('/api/risks/calification_detail','riskFactorCalificationDetailController');


Route::resource('/api/risks/asignation','RiskAsignationsController');


Route::resource('/api/risks/proccess','RiskProccessController');




Route::post('/api/risks/impact','RisksImpactController@index');
Route::get('/api/risks/impact','RisksImpactController@index');
Route::get('/api/risks/impact/{id}','RisksImpactController@show');

Route::post('/api/risks/frecuency','RisksFrecuencyController@index');
Route::get('/api/risks/frecuency','RisksFrecuencyController@index');
Route::get('/api/risks/frecuency/{id}','RisksFrecuencyController@show');

Route::post('/api/risks/factortype','RisksFactorTypeController@index');
Route::get('/api/risks/factortype','RisksFactorTypeController@index');
Route::get('/api/risks/factortype/{id}','RisksFactorTypeController@show');


Route::put('/api/risks/factor/delete/{id}','risks\RisksFactorController@destroy');
Route::post('/api/risks/factor','risks\RisksFactorController@index');
//Route::resource('/api/risks/factor','risks\RisksFactorController@index');
Route::get('/api/risks/factor','risks\RisksFactorController@index');
Route::post('/api/risks/factor/search','risks\RisksFactorController@indexSearch');
//Route::get('/api/risks/factor','RisksFactorController@store');
Route::get('/api/risks/factor/{id}','risks\RisksFactorController@show');
//Route::resource('/api/risks/factor','risks\RisksFactorController')->middleware('cors');
Route::put('/api/risks/factor/{id}','risks\RisksFactorController@update');

//Route::resource('/api/audit/question','audit\AuditQuestionController')->middleware('cors');
Route::resource('/api/risks/factor','risks\RisksFactorController');

Route::resource('/api/risks/risks','risks\RisksController');
Route::put('/api/risks/risks/{id}','audit\RisksController@update');



Route::resource('/api/risks/actions','risks\RisksActionController');
Route::get('/api/risks/actions/{id_risks}/risk','risks\RisksActionController@indexRisks');

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


Route::post('/api/risks/control','RisksControlController@index');
Route::get('/api/risks/control','RisksControlController@index');
Route::get('/api/risks/control/{id}','RisksControlController@show');



//Route::resource('/api/risks/factors','risks\RisksFactorController');
//Route::resource('/api/risks/factor','RiskFactorController');


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
Route::get('/api/audit/audit/{id_audit}/audit','audit\AuditController@index');
Route::post('/api/audit/audit/search','audit\AuditController@indexSearch');

Route::post('/api/audit/format','audit\AuditFormatController@index');
Route::post('/api/audit/format/search','audit\AuditFormatController@search');
Route::put('/api/audit/format/{id}','audit\AuditFormatController@update');
Route::get('/api/audit/format','audit\AuditFormatController@index');
Route::get('/api/audit/format/{id}','audit\AuditFormatController@show');

Route::resource('/api/audit/planning','audit\AuditPlanningController');
Route::get('/api/audit/planning/{id_audit}/audit','audit\AuditPlanningController@indexAudit');

Route::resource('/api/audit/program','audit\AuditProgramController');

Route::post('/api/audit/inform','audit\AuditInformController@index');
Route::put('/api/audit/inform/{id}','audit\AuditInformController@update');
Route::get('/api/audit/inform','audit\AuditInformController@index');
Route::get('/api/audit/inform/{id}/audit','audit\AuditInformController@showByAudit');
Route::get('/api/audit/inform/{id}','audit\AuditInformController@show');
Route::get('/api/audit/inform/hallazgo/{id}','audit\AuditInformController@getHallazgos');
Route::resource('/api/audit/inform','audit\AuditInformController');


Route::resource('/api/audit/question','audit\AuditQuestionController')->middleware('cors');


//Route::resource('/api/Admin/user','Admin\UserController');
Route::post('/api/Admin/user/login','Admin\UserController@login');
Route::get('/api/Admin/user/login','Admin\UserController@login');



Route::get('/clear-cache', function(){
	$code = Artisan::call('clear:cache');
});