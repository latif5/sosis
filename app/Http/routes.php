<?php

use \Faker\Factory;

use App\Inbox;
use App\Outbox;
use App\Confirmation;
use App\Donation;

/**
 * Auth Routes
 */
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 * Guest Routes.
 */
Route::resource('guest', 'GuestController',
        ['only' => ['index', 'login']]);

/**
 * Home Routes.
 */
Route::get('login', ['as' => 'home.login', 'uses' => 'HomeController@login']);
Route::post('authenticate', ['as' => 'home.login.post', 'uses' => 'HomeController@index']);
Route::resource('home', 'HomeController',
        ['only' => ['index']]);

/**
 * Send Routes.
 */
Route::post('send/reply', ['as' => 'send.reply', 'uses' => 'SendController@reply']);
Route::post('send/forward', ['as' => 'send.forward', 'uses' => 'SendController@forward']);
Route::resource('send', 'SendController',
        ['only' => ['create', 'store']]);

/**
 * Inbox Routes.
 */
Route::get('inbox/export/plain', ['as' => 'inbox.export.plain', 'uses' => 'InboxController@exportPlain']);
Route::get('inbox/export/{format}', ['as' => 'inbox.export', 'uses' => 'InboxController@export']);
Route::post('inbox/deleteMultiple', ['as' => 'inbox.delete.multiple', 'uses' => 'InboxController@deleteMultiple']);
Route::get('inbox/delete/{inbox}', ['as' => 'inbox.delete', 'uses' => 'InboxController@delete']);
Route::resource('inbox', 'InboxController',
        ['only' => ['index']]);

/**
 * Outbox Routes.
 */
Route::get('outbox/export/plain', ['as' => 'outbox.export.plain', 'uses' => 'OutboxController@exportPlain']);
Route::get('outbox/export/{format}', ['as' => 'outbox.export', 'uses' => 'OutboxController@export']);
Route::post('outbox/deleteMultiple', ['as' => 'outbox.delete.multiple', 'uses' => 'OutboxController@deleteMultiple']);
Route::get('outbox/delete/{outbox}', ['as' => 'outbox.delete', 'uses' => 'OutboxController@delete']);
Route::get('outbox/truncate', ['as' => 'outbox.truncate', 'uses' => 'OutboxController@truncate']);
Route::resource('outbox', 'OutboxController',
        ['only' => ['index', 'destroy']]);

/**
 * SentItem Routes.
 */
Route::get('sentitem/export/plain', ['as' => 'sentitem.export.plain', 'uses' => 'SentItemController@exportPlain']);
Route::get('sentitem/export/{format}', ['as' => 'sentitem.export', 'uses' => 'SentItemController@export']);
Route::post('sentitem/deleteMultiple', ['as' => 'sentitem.delete.multiple', 'uses' => 'SentItemController@deleteMultiple']);
Route::get('sentitem/delete/{sentitem}', ['as' => 'sentitem.delete', 'uses' => 'SentItemController@delete']);
Route::resource('sentitem', 'SentItemController',
        ['only' => ['index']]);

/**
 * Contact Routes.
 */
Route::get('contact/export/plain', ['as' => 'contact.export.plain', 'uses' => 'ContactController@exportPlain']);
Route::get('contact/export/{format}', ['as' => 'contact.export', 'uses' => 'ContactController@export']);
Route::get('contact/import', ['as' => 'contact.import', 'uses' => 'ContactController@import']);
Route::post('contact/import', ['as' => 'contact.import.post', 'uses' => 'ContactController@importPost']);
Route::post('contact/deleteMultiple', ['as' => 'contact.delete.multiple', 'uses' => 'ContactController@deleteMultiple']);
Route::get('contact/delete/{contact}', ['as' => 'contact.delete', 'uses' => 'ContactController@delete']);
Route::resource('contact', 'ContactController',
        ['only' => ['index', 'create', 'store', 'edit', 'update']]);

/**
 * Group Routes.
 */
Route::get('group/export/plain', ['as' => 'group.export.plain', 'uses' => 'GroupController@exportPlain']);
Route::get('group/export/{format}', ['as' => 'group.export', 'uses' => 'GroupController@export']);
Route::post('group/deleteMultiple', ['as' => 'group.delete.multiple', 'uses' => 'GroupController@deleteMultiple']);
Route::get('group/member/{group}', ['as' => 'group.member.edit', 'uses' => 'GroupController@memberEdit']);
Route::put('group/member/{group}', ['as' => 'group.member.update', 'uses' => 'GroupController@memberUpdate']);
Route::get('group/delete/{group}', ['as' => 'group.delete', 'uses' => 'GroupController@delete']);
Route::resource('group', 'GroupController',
        ['only' => ['index', 'create', 'store', 'edit', 'update']]);

/**
 * Confirmation Routes.
 */
Route::get('confirmation/export/plain', ['as' => 'confirmation.export.plain', 'uses' => 'ConfirmationController@exportPlain']);
Route::get('confirmation/export/{format}', ['as' => 'confirmation.export', 'uses' => 'ConfirmationController@export']);
Route::post('confirmation/deleteMultiple', ['as' => 'confirmation.delete.multiple', 'uses' => 'ConfirmationController@deleteMultiple']);
Route::get('confirmation/delete/{confirmation}', ['as' => 'confirmation.delete', 'uses' => 'ConfirmationController@delete']);
Route::get('confirmation/{confirmation}/{status}', ['as' => 'confirmation.status', 'uses' => 'ConfirmationController@status']);
Route::resource('confirmation',  'ConfirmationController',
        ['only' => ['index']]);

/**
 * Donation Routes.
 */
Route::get('donation/export/plain', ['as' => 'donation.export.plain', 'uses' => 'DonationController@exportPlain']);
Route::get('donation/export/{format}', ['as' => 'donation.export', 'uses' => 'DonationController@export']);
Route::post('donation/deleteMultiple', ['as' => 'donation.delete.multiple', 'uses' => 'DonationController@deleteMultiple']);
Route::get('donation/delete/{donation}', ['as' => 'donation.delete', 'uses' => 'DonationController@delete']);
Route::get('donation/{donation}/{status}', ['as' => 'donation.status', 'uses' => 'DonationController@status']);
Route::resource('donation',  'DonationController',
        ['only' => ['index']]);

/**
 * Balance Routes.
 */
Route::resource('balance',  'BalanceController',
        ['only' => ['index']]);

/**
 * User Routes.
 */
Route::get('user/delete/{user}', ['as' => 'user.delete', 'uses' => 'UserController@delete']);
Route::resource('user', 'UserController',
        ['only' => ['index', 'create', 'store', 'edit', 'update']]);

/**
 * Setting Routes.
 */
Route::resource('setting',  'SettingController',
        ['only' => ['index']]);