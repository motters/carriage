<?php

/**
 * Authentication
 */
Route::get('/', function(){
    return redirect('hubs');
});
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
    Route::get('hubs/{id}/view', 'Hub\HubView@index');
    Route::post('hubs/create', 'Hub\Hub@create');
    Route::put('hubs/{id}/general', 'Hub\Hub@updateGeneralSettings');
    Route::put('hubs/{id}/api', 'Hub\Hub@updateAPISettings');
    Route::put('hubs/{id}/hardware', 'Hub\Hub@updateHardwareSetup');
    Route::delete('hubs/{id}', 'Hub\Hub@delete');
    Route::get('hubs/module/{id}/cache', 'Hub\HubView@cache');
    Route::get('hubs/module/{id}/download', 'Hub\HubView@download');

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

Route::get('test', function(){
    // Grade data
    $hub = json_decode(App\Database\Hubs::where('api_key', '8zA4N3vDrhgEFQugX4ThtO1Ch')->first());

    // reduce data
    $data = json_decode($hub->module_configuration);

    foreach($data->sub_hubs as $no => $values){
        unset($values->name);
        $data->sub_hubs[$values->api_key] = $values;
        unset($data->sub_hubs[$no]);
        foreach($data->modules as $mno => $mvalues){
            unset($mvalues->name);
            if($mvalues->sub_hub == $values->api_key){
                unset($mvalues->sub_hub);
                $data->sub_hubs[$values->api_key]->modules[] = $mvalues;
            }
        }
    }
    unset($data->modules);
    $data = $data->sub_hubs;
    dd($data);
});


/**
 * API routes
 *
 * @protected via api login
 */
Route::group(['prefix' => 'api/v1', 'middleware' => 'microAPIAuth'], function () {

    Route::get('config/{api}', 'Api\Config@show');

    Route::post('upload/{api}', 'Api\Upload@upload');
});

