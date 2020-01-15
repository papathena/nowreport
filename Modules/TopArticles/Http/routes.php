<?php

Route::group(['middleware' => 'web', 'prefix' => 'ga/toparticles', 'namespace' => 'Modules\TopArticles\Http\Controllers'], function()
{
    Route::get('daily', 'DailyTopArticlesController@dailyTopArticles');
    Route::get('monthly', 'MonthlyTopArticlesController@monthlyTopArticles');
	
	Route::get('csdaily', 'DailyTopCSArticlesController@dailyTopCSArticles');
	Route::get('csmonthly', 'MonthlyTopCSArticlesController@monthlyTopCSArticles');

	Route::get('sndaily', 'DailyTopSNArticlesController@dailyTopSNArticles');
	Route::get('snmonthly', 'MonthlyTopSNArticlesController@monthlyTopSNArticles');
	
	Route::get('imdaily', 'DailyTopIMArticlesController@dailyTopIMArticles');
	Route::get('immonthly', 'MonthlyTopIMArticlesController@monthlyTopIMArticles');

	Route::get('alldailypull', 'Pull\DailyTopArticlesController@dailyPull');
    Route::get('allmonthlypull', 'Pull\MonthlyTopArticlesController@monthlyPull');

	Route::get('newsdailypull', 'Pull\DailyTopNewsArticlesController@dailyPull');
    Route::get('newsmonthlypull', 'Pull\MonthlyTopNewsArticlesController@monthlyPull');

	Route::get('photodailypull', 'Pull\DailyTopPhotoArticlesController@dailyPull');
    Route::get('photomonthlypull', 'Pull\MonthlyTopPhotoArticlesController@monthlyPull');

	Route::get('pushdailypull', 'Pull\DailyTopPushArticlesController@dailyPull');
    Route::get('pushmonthlypull', 'Pull\MonthlyTopPushArticlesController@monthlyPull');

	Route::get('csdailypull', 'Pull\DailyTopCSArticlesController@dailyPull');
    Route::get('csmonthlypull', 'Pull\MonthlyTopCSArticlesController@monthlyPull');

	Route::get('sndailypull', 'Pull\DailyTopSNArticlesController@dailyPull');
    Route::get('snmonthlypull', 'Pull\MonthlyTopSNArticlesController@monthlyPull');

	Route::get('imdailypull', 'Pull\DailyTopIMArticlesController@dailyPull');
    Route::get('immonthlypull', 'Pull\MonthlyTopIMArticlesController@monthlyPull');

});
