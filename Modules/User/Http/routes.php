<?php

//Auth::routes();

Route::group(['middleware' => ['web'], 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    //Route::get('/', 'UserController@index');
	Route::resource('users', 'UserController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');
});

