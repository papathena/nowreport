<?php
namespace Modules\TopArticles\Helpers;

use App\Helpers\AnalyticsHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class TopIMArticlesHelper {
    /* Inbound Marketing Top Articles */
    /* B: of Daily Top Articles */
    public static function webTopIMArticles(Period $period, String $devices, String $inmarket, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:pageTitle'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:pageTitle',
                'filters' => $filters,
                'sort' => '-ga:users',
                'max-results' => 15
            ];
        }
        $metrics = 'ga:users,ga:pageviews';

        $respons = AnalyticsHelper::getWebData($period, $metrics, $others);

        $analyticsData = Collect($respons['rows']?? [])->map(function (array $pageRow) use ($devices,$channels, $inmarket) {
            $datas = [
                'date' => Carbon::createFromFormat('Ymd', $pageRow[0])->format('Y-m-d'),
                'dayDate' => $pageRow[1],
                'dayName' => $pageRow[2],
                'weekYear' => $pageRow[3],
                'yearMonth' => $pageRow[4],
                'pageTitle' => $pageRow[5],
                'inmarket' => $inmarket,
                'visitors' => (int) $pageRow[6],
                'pageviews' => (int) $pageRow[7],
                'devices' => $devices,
                'channels' => $channels,
            ];

            return $datas;
        });

        return $analyticsData;

    }

    public static function androidTopIMArticles(Period $period, String $devices, String $inmarket, String $channels=NULL,  String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName',
                'filters' => $filters,
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
                'yearMonth' => $data[4],
                'pageTitle' => $data[5],
                'inmarket' => $inmarket,
                'visitors' => (int) $data[6],
                'pageviews' => (int) $data[7],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }

        return $analyticsData;

    }

    public static function iosTopIMArticles(Period $period, String $devices, String $inmarket, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:yearMonth,ga:screenName',
                'filters' => $filters,
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
                'yearMonth' => $data[4],
                'pageTitle' => $data[5],
                'inmarket' => $inmarket,
                'visitors' => (int) $data[6],
                'pageviews' => (int) $data[7],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }

        return $analyticsData;

    }
    /* End of Daily Top Articles */

	/* Start of Monthly Top Articles */
    public static function webTopIMArticlesMonthly(Period $period, String $devices, String $inmarket, String $channels=NULL, String $filters=NULL)
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
                'inmarket' => $inmarket,
                'visitors' => (int) $data[3],
                'pageviews' => (int) $data[4],
                'devices' => $devices,
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }

    public static function androidTopIMArticlesMonthly(Period $period, String $devices, String $inmarket, String $channels=NULL, String $filters=NULL)
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
                'inmarket' => $inmarket,
                'visitors' => (int) $data[3],
                'pageviews' => (int) $data[4],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }

    public static function iosTopIMArticlesMonthly(Period $period, String $devices, String $inmarket, String $channels=NULL, String $filters)
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
                'inmarket' => $inmarket,
                'visitors' => (int) $data[3],
                'pageviews' => (int) $data[4],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }

        return $analyticsData;
    }
    /* End of Monthly Top Articles */
}