<?php

Route::group(['middleware' => ['web'], 'prefix' => 'ga', 'namespace' => 'Modules\Ga\Http\Controllers'], function()
{
    Route::get('/', 'GaController@index')->name('gaindex');
});
