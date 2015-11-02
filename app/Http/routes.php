<?php

/**
 * Authentication
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


/**
 * Application routes
 *
 * @protected via auth login
 */
Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('dashboard', 'Dashboard@index');


    // Hubs
    Route::get('hubs', 'Hub\Hub@index');
    Route::get('hubs/{id}/edit', 'Hub\Hub@edit');
    Route::get('hubs/add', 'Hub\Hub@add');
    Route::get('hubs/{id}', 'Hub\HubView@index');
    Route::post('hubs/edit/{id}', 'Hub\Hub@editPost');
    Route::post('hubs/add', 'Hub\Hub@addPost');


    // Users
    Route::get('users', 'Users\User@index');
    Route::get('users/add', 'Users\User@add');
    Route::get('users/{id}/edit', 'Users\User@edit');
    Route::get('profile', 'Users\User@profile');
    Route::post('users/add', 'Users\User@addPost');
    Route::post('users/{id}/edit', 'Users\User@editPost');


    // Settings
    Route::get('settings', 'Settings@index');
    Route::post('settings', 'Settings@post');

});


