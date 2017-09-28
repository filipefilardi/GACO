<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/home', 'RequestController@accept_request');

Route::get('/garbage', 'GarbageController@index_garbage');

Route::get('/request', 'RequestController@index_user');
Route::post('/request', 'RequestController@make_request');
Route::post('/request/cancel', 'RequestController@cancel_request');
Route::post('/request/confirm', 'RequestController@confirm_request');
Route::post('/request/postpone', 'RequestController@postpone_request');
Route::get('/notification', 'RequestController@index_customer');

Route::get('/evaluation', 'EvaluationController@index_evaluation');
Route::post('/evaluation', 'EvaluationController@make_evaluation');

Route::get('/complete_registration', 'CompleteRegistrationController@indexCompleteRegistration');
Route::post('/complete_registration', 'CompleteRegistrationController@completeRegistration');

Route::get('/admin', 'AdminController@index_admin');
Route::post('/admin', 'AdminController@insertCoop');

Route::get('/about', 'HomeController@index_about');

/* SETTINGS */
Route::get('/settings', 'SettingsController@indexSettings');
Route::post('/register/address', 'SettingsController@registerAddress');
Route::post('/delete/address', 'SettingsController@deleteAddress');
Route::post('/update/password', 'SettingsController@updatePassword');
Route::post('/delete/account', 'SettingsController@deleteAccount');

Route::get('/activate/account', 'Auth2000Controller@indexActivateAccount');
Route::post('/activate/account', 'Auth2000Controller@loginActivateAccount');

Route::get('/cooperatives', 'CooperativesController@index_cooperatives');

Route::get('/send', 'MailController@send');
