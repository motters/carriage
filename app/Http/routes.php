<?php

/**
 * Authentication
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


/**
 * Application routes
 */
Route::get('/dashboard', function () {
    return view('vendor.manchesterTemplate.dashboard');
});


