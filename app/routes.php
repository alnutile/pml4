<?php

Route::get('/', array('before' => 'auth', function()
{
    return Redirect::to('dashboard');
}));

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


Route::group(array('prefix' => 'github'), function() {
    Route::get('github', 'PML4\GitHubService@index');
    Route::get('authorize', 'PML4\GitHubService@authorize');
    Route::get('callback', 'PML4\GitHubService@callback');
    Route::get('issues/{owner}/{repo}', function($owner, $repo){
        return GitHubService::getIssues($owner, $repo);
    });
    Route::get('projects/{owner}', function($owner){
        return GitHubService::getAllProjects($owner);
    });
    Route::get('sync/project/{project_id}/{repo_owner}/{repo_name}', array('before' => 'auth', function($project_id, $repo_owner, $repo_name){
        $sync = new \PML4\GitHubProjectsAndIssuesController();
        return $sync->getIssuesThatAreNotLocal($project_id, $repo_owner, $repo_name);
    }));
});