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

// Contact route
Route::get('/contact', 'Frontend\ContactController@index')->name('contact.index');
Route::post('/contact/verzend', 'Frontend\ContactController@send')->name('contact.send');

// Notification routes
Route::get('/admin/notificaties', 'Backend\NotificationController@index')->name('notifications.index');
Route::get('/admin/notificaties/alles-gelezen', 'Backend\NotificationController@markAll')->name('notifications.markall');
Route::get('/admin/notificaties/gelezen/{id}', 'Backend\NotificationController@markOne')->name('notifications.markOne');

// Signature route
Route::post('/onderteken', 'Frontend\SignatureController@store')->name('signature.store');
Route::get('/onderteken/verwijder', 'Frontend\SignatureController@unsubscribe')->name('signature.delete');

// Frontend news routes
Route::get('/nieuws', 'Frontend\NewsController@index')->name('news.index');
Route::get('/neuws/{slug}', 'Frontend\NewsController@show')->name('news.show');

// Backend news routes
Route::get('/admin/nieuws', 'Backend\NewsController@index')->name('admin.news.index');
Route::get('/admin/nieuws/creatie', 'Backend\NewsController@create')->name('admin.news.create');
Route::get('/admin/nieuws/wijzig/{slug}', 'Backend\NewsController@edit')->name('admin.news.edit');
Route::patch('/admin/nieuws/wijzig/{slug}', 'Backend\NewsController@update')->name('admin.news.update');
Route::get('/admin/nieuws/verwijder/{slug}', 'Backend\NewsController@destroy')->name('admin.news.destroy');
Route::post('/admin/nieuws/opslaan', 'Backend\NewsController@store')->name('admin.news.store');

// Disclaimer routes
Route::get('/disclaimer', 'Frontend\DisclaimerController@index')->name('disclaimer.index');

// Backend activity console routes
Route::get('/admin/logs', 'Backend\ActivityController@index')->name('admin.logs.index');
Route::get('/admin/logs/zoek', 'Backend\ActivityController@search')->name('admin.logs.search');

// Stads monitor routes (Backend)
Route::get('/admin/stadsmonitor', 'Backend\StadsMonitorController@index')->name('admin.stadsmonitor.index');
Route::get('/admin/stadsmonitor/{city}/{status}', 'Backend\StadsMonitor\NukeFreeController@show')->name('admin.stadsmonitor.status');
Route::get('/admin/stadsmonitor/{city}', 'Backend\StadsMonitorController@show')->name('admin.stadsmonitor.show');
Route::get('/admin/zoek/stad', 'Backend\StadsMonitorController@search')->name('admin.stadsmonitor.search');

// Stads monitor routes (Frontend)
Route::get('/stadsmonitor', 'Frontend\StadsMonitorController@index')->name('stadsmonitor.index');
Route::get('/stadsmonitor/zoek', 'Frontend\StadsMonitorController@search')->name('stadsmonitor.search');
Route::get('/stadsmonitor/{name}', 'Frontend\StadsMonitorController@show')->name('stadsmonitor.show');

// User management routes
Route::get('/admin/gebruikers', 'Backend\UsersController@index')->name('admin.users.index');
Route::get('/admin/wijzig/{id}', 'Backend\UsersController@edit')->name('admin.users.edit');
Route::get('/admin/gebruikers/nieuw', 'Backend\UsersController@create')->name('admin.users.create');
Route::get('/admin/gebruikers/verwijder/{id}', 'Backend\UsersController@destroy')->name('admin.users.delete');
Route::post('/admin/gebruikers/creatie', 'Backend\UsersController@store')->name('admin.users.store');

// Ban routes
Route::get('/admin/gebruikers/blokkeer/{id}', 'Backend\BanController@lock')->name('admin.users.lock');
Route::get('/admin/gebruikers/activeer/{id}', 'Backend\BanController@destroy')->name('admin.users.active');

// Support routes (frontend)
Route::get('/ondersteuning', 'Frontend\SupportController@index')->name('support.index');

// Support routes (backend)
Route::get('/admin/ondersteuning', 'Backend\SupportController@index')->name('admin.support.index');
Route::get('/admin/ondersteuning/create', 'Backend\SupportController@create')->name('admin.support.create');
Route::get('/admin/ondersteuning/wijzig/{id}', 'Backend\SupportController@edit')->name('admin.support.edit');
Route::get('/admin/ondersteuning/verwijder/{id}', 'Backend\SupportController@destroy')->name('admin.support.delete');
Route::get('/admin/ondersteuning/zoek', 'Backend\SupportController@search')->name('admin.support.search');
Route::post('/admin/ondersteuning/opslaan', 'Backend\SupportController@store')->name('admin.support.store');
Route::patch('/admin/ondersteuning/wijzig/{id}', 'Backend\SupportController@update')->name('admin.support.update');

// Notition routes
Route::get('/admin/notities/nieuw/{city}', 'Backend\NotitionController@create')->name('admin.notition.create');
Route::get('/admin/notities/verwijder/{notition}/{city}', 'Backend\NotitionController@destroy')->name('admin.notition.delete');
Route::post('/admin/notities/opslaan/{city}', 'Backend\NotitionController@store')->name('admin.notition.store');

// API key routes
Route::post('/admin/api-token-opslaan', 'Auth\ApiKeysController@store')->name('admin.apikey.store');
Route::get('/admin/api/regenerate/{id}', 'Auth\ApiKeysController@regenerate')->name('admin.apikey.regenerate');
Route::get('/admin/api/verwijder/{id}', 'Auth\ApiKeysController@destroy')->name('admin.apikey.delete');

// News backend routes
Route::get('/admin/nieuws', 'Backend\NewsController@index')->name('admin.news.index');
Route::get('/admin/nieuws/creer', 'Backend\NewsController@create')->name('admin.news.create');
