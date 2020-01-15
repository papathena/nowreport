<?php

Route::group(['middleware' => 'web', 'prefix' => 'ga/achievement', 'namespace' => 'Modules\Achievement\Http\Controllers'], function()
{
    Route::get('/', 'AchievementController@index');
});
