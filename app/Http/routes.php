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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', ['as' => 'home.index', function () {
    return view('home.index');
}]);

Route::get('login', ['as' => 'guest.login', function () {
    return view('guest.login');
}]);

Route::get('send/create', ['as' => 'send.create', function () {
    return view('send.create');
}]);