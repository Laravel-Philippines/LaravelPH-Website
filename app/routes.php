<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::when('*', 'csrf', array('post'));

Route::get('/', ['as' => 'laravelph.showHomePage', 'uses' => 'LaravelPH\LaravelPH\Controllers\LaravelPHController@showHomePage']);

Route::resource('users', 'LaravelPH\User\Controllers\UserController');

Route::resource('sessions', 'LaravelPH\Session\Controllers\SessionController');

Route::resource('jobs', 'LaravelPH\Job\Controllers\JobController');