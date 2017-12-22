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

// Home routes
Route::get('/', 'Frontend\WelcomeController@index')->name('frontend.index');
Route::get('/home', 'Backend\WelcomeController@index')->name('backend.index');

// Account settings 
Route::get('/admin/account/instellingen/{type}', 'Auth\AccountSettingsController@index')->name('account.settings');
Route::patch('/admin/account/instellingen/informatie', 'Auth\AccountSettingsController@updateInformation')->name('account.settings.info');
Route::patch('/admin/account/instellingen/beveiliging', 'Auth\AccountSettingsController@updateSecurity')->name('account.settings.security');

// Bug routes 
Route::get('/admin/meld-een-probleem', 'Backend\GithubController@create')->name('bug.create');
Route::post('/admin/meld-ons-probleem', 'Backend\GithubController@store')->name('bug.store');

// Signature route
Route::post('/onderteken', 'Frontend\SignatureController@store')->name('signature.store');

// Disclaimer routes
Route::get('/disclaimer', 'Frontend\DisclaimerController@index')->name('disclaimer.index');
