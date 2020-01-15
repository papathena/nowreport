<?php

Route::group(['middleware' => 'web', 'prefix' => 'ga/traffics', 'namespace' => 'Modules\Traffics\Http\Controllers'], function()
{
    Route::get('daily', 'TrafficsController@traffics');
    Route::get('monthly', 'TrafficsController@monthlyTraffics');
    Route::get('daily', 'TrafficsController@traffics');
    Route::get('avgdaily', 'TrafficsController@avgDailyTraffics');

    Route::get('dailypull', 'PulldataController@dailyPull');
    Route::get('monthlypull', 'PulldataController@monthlyPull');
});
