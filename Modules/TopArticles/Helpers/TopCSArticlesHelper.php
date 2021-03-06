<?php
namespace Modules\TopArticles\Helpers;

use App\Helpers\AnalyticsHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class TopCSArticlesHelper {
	/* Channel Source Top Articles */
    /* B: Daily Top Channel Source Articles */
    public static function webTopCSArticles(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:pageTitle,ga:channelGrouping'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:pageTitle,ga:channelGrouping',
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
                //'year' => $pageRow[5],
                'pageTitle' => $pageRow[5],
                'chgroup' => $pageRow[6],
                'visitors' => (int) $pageRow[7],
                'pageviews' => (int) $pageRow[8],
                'devices' => $devices,
                'channels' => $channels,
            ];

            return $datas;
        });

        return $analyticsData;

    }
	
	 public static function androidTopCSArticles(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        //(!is_null($channels)) ? $filters = $channels : $filters = NULL;
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName,ga:channelGrouping'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName,ga:channelGrouping',
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
                //'year' => $data[5],
                'pageTitle' => $data[5],
                'chgroup' => $data[6],
                'visitors' => (int) $data[7],
                'pageviews' => (int) $data[8],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }

        return $analyticsData;

    }
	
	public static function iosTopCSArticles(Period $period, String $devices, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName,ga:channelGrouping'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName,ga:channelGrouping',
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
                //'year' => $data[5],
                'pageTitle' => $data[5],
                'chgroup' => $data[6],
                'visitors' => (int) $data[7],
                'pageviews' => (int) $data[8],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }

        return $analyticsData;

    }
	/* E: Daily Top Channel Source Articles */
	
	/* B: Monthly Top Channel Source Articles */
	public static function webTopCSArticlesMonthly(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year,ga:pageTitle,ga:channelGrouping'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year,ga:pageTitle,ga:channelGrouping',
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
                'chgroup' => $data[3],
                'visitors' => (int) $data[4],
                'pageviews' => (int) $data[5],
                'devices' => $devices,
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
	
	public static function androidTopCSArticlesMonthly(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year,ga:screenName,ga:channelGrouping'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year,ga:screenName,ga:channelGrouping',
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
                'chgroup' => $data[3],
                'visitors' => (int) $data[4],
                'pageviews' => (int) $data[5],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
	
	public static function iosTopCSArticlesMonthly(Period $period, String $devices, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year,ga:screenName,ga:channelGrouping'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year,ga:screenName,ga:channelGrouping',
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
                'chgroup' => $data[3],
                'visitors' => (int) $data[4],
                'pageviews' => (int) $data[5],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
    /* E: Monthly Top Channel Source Articles */
}
