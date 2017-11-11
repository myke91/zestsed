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
    
    return view('main');
});
Route::get('/registrations', ['as' => 'registrations', 'uses' => 'RegistrationController@registrations']);
Route::get('/contributions', ['as' => 'contributions', 'uses' => 'ContributionController@contributions']);
Route::get('/investments', ['as' => 'investments', 'uses' => 'InvestmentController@investments']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);


//Mobile API
Route::post('/mobile/register', ['as' => 'saveRegistration', 'uses' => 'RegistrationController@saveRegistration']);
Route::post('/mobile/login', ['as' => 'mobileLogin', 'uses' => 'Auth\LoginController@mobileLogin']);
Route::post('/mobile/registerDevice',['as'=>'registerDevice','uses'=>'RegistrationController@registerDevice']);