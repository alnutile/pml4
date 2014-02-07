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

Route::get('/', array('before' => 'auth', function()
{
    return Redirect::to('dashboard');
}));

//Route::resource('users', 'UsersController');// Confide routes
Route::get( 'signup',                 'UserController@signup');
Route::post('register',               'UserController@register');
Route::get( 'login',                  'UserController@login');
Route::post('login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',    'UserController@confirm');
Route::get( 'forgot_password',        'UserController@forgot_password');
Route::post('forgot_password',        'UserController@do_forgot_password');
Route::get( 'reset_password/{token}', 'UserController@reset_password');
Route::post('reset_password',         'UserController@do_reset_password');
Route::get( 'logout',                 'UserController@logout');

Route::get('admin/users', 'UserController@adminUsers');

Route::get('dashboard', array('before' => 'auth', 'uses' => 'DashboardController@index'));

Route::resource('users', 'UserController');
Route::resource('projects', 'ProjectsController');
Route::resource('projects.issues', 'IssuesController');
Route::resource('projects.issues.comments', 'CommentsController');
