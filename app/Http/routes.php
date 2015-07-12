<?php

use \Faker\Factory;

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

Route::get('login', ['as' => 'home.login', 'uses' => 'HomeController@login']);
Route::post('authenticate', ['as' => 'home.login.post', 'uses' => 'HomeController@index']);
Route::resource('home', 'HomeController',
        ['only' => ['index']]);

Route::post('send/reply', ['as' => 'send.reply', 'uses' => 'SendController@reply']);
Route::resource('send', 'SendController',
        ['only' => ['create', 'store']]);

Route::get('inbox/delete/{inbox}', ['as' => 'inbox.delete', 'uses' => 'InboxController@delete']);
Route::resource('inbox', 'InboxController',
        ['only' => ['index']]);

Route::get('outbox/delete/{outbox}', ['as' => 'outbox.delete', 'uses' => 'OutboxController@delete']);
Route::get('outbox/truncate', ['as' => 'outbox.truncate', 'uses' => 'OutboxController@truncate']);
Route::resource('outbox', 'OutboxController',
        ['only' => ['index', 'destroy']]);

Route::get('sentitem/delete/{sentitem}', ['as' => 'sentitem.delete', 'uses' => 'SentItemController@delete']);
Route::resource('sentitem', 'SentItemController',
        ['only' => ['index']]);

Route::resource('contact', 'ContactController',
        ['only' => ['index', 'create', 'store', 'show']]);

Route::resource('group', 'GroupController',
        ['only' => ['index', 'create']]);

Route::resource('balance',  'BalanceController',
        ['only' => ['index']]);

Route::resource('user', 'UserController',
        ['only' => ['index', 'create']]);

Route::resource('setting',  'SettingController',
        ['only' => ['index']]);

Route::resource('confirmation',  'ConfirmationController',
        ['only' => ['index']]);

Route::resource('donation',  'DonationController',
        ['only' => ['index']]);

Route::get('fin', function (){
        $faker = Factory::create();
        // dd($faker->dateTimeThisYear);
        return $faker->text(100);
});