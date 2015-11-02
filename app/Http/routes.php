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
    Route::post('hubs/create', 'Hub\Hub@addPost');
    Route::put('hubs/{id}', 'Hub\Hub@editPost');
    Route::delete('hubs/{id}', 'Hub\Hub@delete');


    // Users
    Route::get('users', 'Users\User@index');
    Route::get('users/add', 'Users\User@add');
    Route::get('users/{id}/edit', 'Users\User@edit');
    Route::get('profile', 'Users\User@profile');
    Route::post('users/create', 'Users\User@addPost');
    Route::put('users/{id}', 'Users\User@editPost');
    Route::delete('users/{id}', 'Users\User@delete');


    // Settings
    Route::get('settings', 'Settings@index');
    Route::post('settings', 'Settings@post');

});


