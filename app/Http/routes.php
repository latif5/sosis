<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('guest', 'GuestController',
        ['only' => ['index', 'login']]);

Route::resource('home', 'HomeController',
        ['only' => ['index']]);

Route::resource('send', 'SendController',
        ['only' => ['create']]);

Route::resource('inbox', 'InboxController',
        ['only' => ['index']]);

Route::resource('outbox', 'OutboxController',
        ['only' => ['index']]);

Route::resource('sentitem', 'SentItemController',
        ['only' => ['index']]);

Route::resource('contact', 'ContactController',
        ['only' => ['index', 'create']]);

Route::resource('group', 'GroupController',
        ['only' => ['index', 'create']]);

Route::resource('setting',  'SettingController',
        ['only' => ['index']]);

Route::resource('balance',  'BalanceController',
        ['only' => ['index']]);