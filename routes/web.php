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

Route::get('/', ['as' => 'dashboard', 'uses' => 'MainController@dashboard']);
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'MainController@dashboard']);


//Route::get('/registrations', ['as' => 'registrations', 'uses' => 'RegistrationController@registrations']);
//Route::get('/contributions', ['as' => 'contributions', 'uses' => 'ContributionController@contributions']);
//Route::get('/investments', ['as' => 'investments', 'uses' => 'InvestmentController@investments']);

Route::get('/',['as'=>'dashboard','uses'=>'MainController@dashboard']);
Route::get('addContribution',['as'=>'addContribution','uses'=>'ContributionController@addContribution']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/registration/approve', ['as' => 'approveRegistration', 'uses' => 'RegistrationController@approveRegistration']);
Route::get('/contribution/approve', ['as' => 'approveContribution', 'uses' => 'ContributionController@approveContribution']);


//Mobile API
Route::post('/mobile/register', ['as' => 'saveRegistration', 'uses' => 'RegistrationController@saveRegistration']);
Route::post('/mobile/login', ['as' => 'mobileLogin', 'uses' => 'Auth\LoginController@mobileLogin']);
Route::post('/mobile/registerDevice', ['as' => 'registerDevice', 'uses' => 'RegistrationController@registerDevice']);
Route::post('/mobile/setPassword', ['as' => 'setPassword', 'uses' => 'Auth\LoginController@setPassword']);
Route::post('/mobile/addContribution', ['as' => 'saveContribution', 'uses' => 'ContributionController@saveContribution']);
Route::get('/mobile/getContributions', ['as' => 'getContributions', 'uses' => 'ContributionController@getContributions']);


Route::resource('registrations', 'RegistrationController');
Route::resource('contributions', 'ContributionController');
Route::resource('investments', 'InvestmentController');

