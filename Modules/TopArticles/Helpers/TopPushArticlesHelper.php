<?php
namespace Modules\TopArticles\Helpers;

use App\Helpers\AnalyticsHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class TopPushArticlesHelper {
	/* Push Notification Top Articles */
    /* B: Daily Top Push Notification Articles */
    public static function webTopPushArticles(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year,ga:pageTitle'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year,ga:pageTitle',
                'filters' => $filters,
               // 'sort' => '-ga:pageviews',
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:pageviews';

        $respons = AnalyticsHelper::getWebData($period, $metrics, $others);

        $analyticsData = Collect($respons['rows']?? [])->map(function (array $pageRow) use ($devices,$channels) {
            $datas = [
                'date' => Carbon::createFromFormat('Ymd', $pageRow[0])->format('Y-m-d'),
                'dayDate' => $pageRow[1],
                'dayName' => $pageRow[2],
                'weekYear' => $pageRow[3],
                'monthYear' => $pageRow[4],
                'year' => $pageRow[5],
                'pageTitle' => $pageRow[6],
                'visitors' => (int) $pageRow[7],
                'pageviews' => (int) $pageRow[8],
                'devices' => $devices,
                'channels' => $channels,
            ];

            return $datas;
        });

        return $analyticsData;

    }
	
	 public static function androidTopPushArticles(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        //(!is_null($channels)) ? $filters = $channels : $filters = NULL;
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year,ga:screenName'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year,ga:screenName',
                'filters' => $filters,
                //'sort' => '-ga:screenviews',
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:screenviews';

        $respons = AnalyticsHelper::getAndroidData($period, $metrics, $others);

        $datas = Collect($respons['rows']);
        $analyticsData = [];
        foreach ($datas as $data) {
            $analyticsData[] = [
                'date' => Carbon::createFromFormat('Ymd', $data[0])->format('Y-m-d'),
                'dayDate' => $data[1],
                'dayName' => $data[2],
                'weekYear' => $data[3],
                'monthYear' => $data[4],
                'year' => $data[5],
                'pageTitle' => $data[6],
                'visitors' => (int) $data[7],
                'pageviews' => (int) $data[8],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }

        return $analyticsData;

    }
	
	public static function iosTopPushArticles(Period $period, String $devices, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year,ga:screenName'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year,ga:screenName',
                'filters' => $filters,
                //'sort' => '-ga:screenviews',
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:screenviews';

        $respons = AnalyticsHelper::getIOSData($period, $metrics, $others);

        $datas = Collect($respons['rows']);
        $analyticsData = [];
        foreach ($datas as $data) {
            $analyticsData[] = [
                'date' => Carbon::createFromFormat('Ymd', $data[0])->format('Y-m-d'),
                'dayDate' => $data[1],
                'dayName' => $data[2],
                'weekYear' => $data[3],
                'monthYear' => $data[4],
                'year' => $data[5],
                'pageTitle' => $data[6],
                'visitors' => (int) $data[7],
                'pageviews' => (int) $data[8],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }

        return $analyticsData;

    }
	/* E: Daily Top Push Notification Articles */
	
	/* B: Monthly Top Push Notification Articles */
	public static function webTopPushArticlesMonthly(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year,ga:pageTitle'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year,ga:pageTitle',
                'filters' => $filters,
                //'sort' => '-ga:pageviews',
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:pageviews';

        $respons = AnalyticsHelper::getWebData($period, $metrics, $others);

        $datas = Collect($respons['rows']);
        $analyticsData = [];
        foreach ($datas as $data) {
            $analyticsData[] = [
                'month' => $data[0],
                'year' => $data[1],
                'pageTitle' => $data[2],
                'visitors' => (int) $data[3],
                'pageviews' => (int) $data[4],
                'devices' => $devices,
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
	
	public static function androidTopPushArticlesMonthly(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year,ga:screenName'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year,ga:screenName',
                'filters' => $filters,
                //'sort' => '-ga:screenviews',
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:screenviews';

        $respons = AnalyticsHelper::getAndroidData($period, $metrics, $others);

        $datas = Collect($respons['rows']);
        $analyticsData = [];
        foreach ($datas as $data) {
            $analyticsData[] = [
                'month' => $data[0],
                'year' => $data[1],
                'pageTitle' => $data[2],
                'visitors' => (int) $data[3],
                'pageviews' => (int) $data[4],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
	
	public static function iosTopPushArticlesMonthly(Period $period, String $devices, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year,ga:screenName'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year,ga:screenName',
                'filters' => $filters,
                //'sort' => '-ga:screenviews',
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:screenviews';

        $respons = AnalyticsHelper::getIOSData($period, $metrics, $others);

        $datas = Collect($respons['rows']);
        $analyticsData = [];
        foreach ($datas as $data) {
            $analyticsData[] = [
                'month' => $data[0],
                'year' => $data[1],
                'pageTitle' => $data[2],
                'visitors' => (int) $data[3],
                'pageviews' => (int) $data[4],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
    /* E: Monthly Top Push Notification Articles */
}
