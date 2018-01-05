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

Route::get('/registration/approve/{id}', ['as' => 'approveRegistration', 'uses' => 'RegistrationController@approveRegistration']);
Route::get('/contribution/approve/{id}', ['as' => 'approveContribution', 'uses' => 'ContributionController@approveContribution']);



//Mobile API
Route::post('/mobile/register', ['as' => 'saveRegistration', 'uses' => 'RegistrationController@saveRegistration']);
Route::post('/mobile/login', ['as' => 'mobileLogin', 'uses' => 'Auth\LoginController@mobileLogin']);
Route::post('/mobile/registerDevice', ['as' => 'registerDevice', 'uses' => 'RegistrationController@registerDevice']);
Route::post('/mobile/setPassword', ['as' => 'setPassword', 'uses' => 'Auth\LoginController@setPassword']);
Route::post('/mobile/addContribution', ['as' => 'saveContribution', 'uses' => 'ContributionController@saveContribution']);
Route::get('/mobile/getContributions', ['as' => 'getContributions', 'uses' => 'ContributionController@getContributions']);
Route::get('/mobile/getInvestments',['as'=>'getInvestments','uses'=>'InvestmentController@getInvestments']);
Route::get('/mobile/getHeaderSummary',['as'=>'getHeaderSummary','uses'=>'InvestmentController@getHeaderSummary']);
Route::get('/mobile/profile', ['as' => 'getUserDetails', 'uses' => 'MainController@getUserDetails']);
Route::post('/mobile/update/image',['as'=>'updateProfilePicture','uses'=>'MainController@updateProfilePicture']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'authen'], function () {
    Route::resource('registrations', 'RegistrationController');
    Route::resource('contributions', 'ContributionController');
    Route::resource('investments', 'InvestmentController');
    Route::get("/getUserContributions",['as'=>'getUserContributions','uses'=>'ContributionController@getUserContributions']);
    Route::get('addContribution', ['as' => 'addContribution', 'uses' => 'ContributionController@addContribution']);
    Route::get('/addInvestments', ['as' => 'addInvestments', 'uses' => 'InvestmentController@createInvestment']);
    Route::post('/postInvestments', ['as' => 'postInvestments', 'uses' => 'InvestmentController@postInvestments']);
    Route::get('/show-registrationdetails',['as' => 'showRegDetails', 'uses' => 'RegistrationController@showRegistration']);
    Route::get('/show-contributiondetails',['as'=>'showContributionDetails','uses'=>'ContributionController@showContribution']);
    Route::get('/addUser',['as'=>'addUser','uses'=>'UserController@addUser']);
    Route::post('/post-user', ['as' => 'postUser', 'uses' => 'UserController@postUser']);
    Route::get('/edit-user', ['as' => 'editUser', 'uses' => 'UserController@editUser']);
    Route::post('/update-user', ['as' => 'updateUser', 'uses' => 'UserController@updateUser']);
});
