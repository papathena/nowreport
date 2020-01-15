<?php
namespace Modules\Traffics\Helpers;

use App\Helpers\AnalyticsHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class TrafficHelper {
	
    public static function webTraffics(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $filters = 'all';
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year',
                'filters' => $filters
            ];
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year',
                'filters' => $filters
            ];
        }
        $metrics = 'ga:users,ga:pageviews';

        $respons = AnalyticsHelper::getWebData($period, $metrics, $others);

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
                'visitors' => (int) $data[6],
                'pageviews' => (int) $data[7],
                'devices' => $devices,
                'channels' => $channels,
            ];
        }
        
        return $analyticsData;

    }

    public static function androidTraffics(Period $period, String $devicesm, String $channels=NULL, String $filters=NULL)
    {
        //(!is_null($channels)) ? $filters = $channels : $filters = NULL;
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year',
                'filters' => $filters
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
                'visitors' => (int) $data[6],
                'pageviews' => (int) $data[7],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }
        
        return $analyticsData;

    }

    public static function iosTraffics(Period $period, String $devices, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:date,ga:day,ga:dayOfWeekName,ga:week,ga:month,ga:year',
                'filters' => $filters
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
                'visitors' => (int) $data[6],
                'pageviews' => (int) $data[7],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }
        
        return $analyticsData;

    }

    public static function webTrafficsMonthly(Period $period, String $devices, String $channels=NULL, String $filters=NULL)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year',
                'filters' => $filters
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
                'visitors' => (int) $data[2],
                'pageviews' => (int) $data[3],
                'devices' => $devices,
                'channels' => $channels,
            ];
        }
        
        return $analyticsData;

    }

    public static function androidTrafficsMonthly(Period $period, String $devicesm, String $channels=NULL, String $filters=NULL)
    {
        //(!is_null($channels)) ? $filters = $channels : $filters = NULL;
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year',
                'filters' => $filters
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
                'visitors' => (int) $data[2],
                'pageviews' => (int) $data[3],
                'devices' => 'android',
                'channels' => $channels,
            ];
        }
        
        return $analyticsData;

    }

    public static function iosTrafficsMonthly(Period $period, String $devices, String $channels=NULL, String $filters)
    {
        if (is_null($filters)) {
            $others = ['dimensions' => 'ga:month,ga:year'];
            $filters = 'all';
        } else {
            $others = [
                'dimensions' => 'ga:month,ga:year',
                'filters' => $filters
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
                'visitors' => (int) $data[2],
                'pageviews' => (int) $data[3],
                'devices' => 'ios',
                'channels' => $channels,
            ];
        }
        
        return $analyticsData;

    }
}