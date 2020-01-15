<?php
namespace App\Helpers;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\AnalyticsClientFactory;
use Spatie\Analytics\Period;

class AnalyticsHelper {

	/*public static function getView($viewId)
	{
		$config = config('analytics');
	    $client = AnalyticsClientFactory::createForConfig($config);
	    return new Analytics($client, $viewId);
	}*/

	public static function getView($viewID)
	{
		$config = config('analytics');
	    $client = AnalyticsClientFactory::createForConfig($config);
	    return new Analytics($client, $viewID);
	}

    public static function getWebData(Period $period, String $metric, Array $others=[])
    {
        $analytics = static::getView(env('ANALYTICS_VIEW_ID'));
        return $analytics->performQuery(
            $period,
            $metric,
            $others
        );
    }

    public static function getAndroidData(Period $period, String $metric, Array $others=[])
    {
        $analytics = static::getView(env('ANDROID_APPS_ID'));
        return $analytics->performQuery(
            $period,
            $metric,
            $others
        );
    }

    public static function getIOSData(Period $period, String $metric, Array $others=[])
    {
        $analytics = static::getView(env('IOS_APPS_ID'));
        return $analytics->performQuery(
            $period,
            $metric,
            $others
        );
    }
}
