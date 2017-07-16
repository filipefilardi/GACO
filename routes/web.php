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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/garbage', 'GarbageController@index_garbage');

Route::get('/request', 'RequestController@index_user');
Route::post('/request', 'RequestController@make_request');
Route::get('/notification', 'RequestController@index_customer');

Route::get('/complete_registration', 'CompleteRegistrationController@indexCompleteRegistration');
Route::post('/complete_registration', 'CompleteRegistrationController@completeRegistration');

Route::get('/admin', 'AdminController@index_admin');
Route::post('/admin', 'AdminController@insertCoop');


Route::get('/partners', 'HomeController@index_partners');

Route::get('/about', 'HomeController@index_about');

/* SETTINGS */
Route::get('/settings', 'SettingsController@indexSettings');
Route::post('/settings', 'SettingsController@registerAddress');

