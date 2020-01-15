<?php

namespace Modules\Traffics\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Self Added
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use App\Helpers\MonthName;
use App\Helpers\ChannelColor;
use DB;

class TrafficsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Start: Daily Traffics 
    public static function getTraffics(String $startDate, String $endDate, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android','ios'];
            $traffics = DB::table('ga_traffics')
                ->select(DB::raw('date,dayDate,dayName,sum(visitors) as visitors,sum(pageviews) as pageviews,channels'))
                ->whereIn('devices', $devs)
                ->where('channels', $channels)
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get();
        } else {
            $traffics = DB::table('ga_traffics')
                ->where('devices', $devices)
                ->where('channels', $channels)
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->get();
        }

        $dataTraffic = [];
        $cnt = 1;
        $diffVisitors = '-';
        $diffPageviews = '-';
        $semVisitors = 0;
        $semPageviews = 0;
        foreach ($traffics as $data) {
            if ($cnt > 1) {
                if ($SemVisitors == 0)
                    $diffVisitors = ($data->visitors - $SemVisitors) * 100;
                else
                    $diffVisitors = round((($data->visitors - $SemVisitors)/$SemVisitors), 2) * 100;
                if ($semPageviews == 0)
                    $diffPageviews = ($data->pageviews - $semPageviews) * 100;
                else
                    $diffPageviews = round((($data->pageviews - $semPageviews)/$semPageviews), 2) * 100;
            }
            else {
                $diffVisitors = '-';
                $diffPageviews = '-';
            }

            array_push($dataTraffic, [
                'date' => $data->date,
                'dayDate' => $data->dayDate,
                'dayName' => $data->dayName,
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'diffVisitors' => $diffVisitors,
                'diffPageviews' => $diffPageviews
            ]);

            $SemVisitors = $data->visitors;
            $semPageviews = $data->pageviews;
            $cnt++;
        }
        return $dataTraffic;
    }

    public static function getAvgTraffics(String $startDate, String $endDate, String $devices, String $channels)
    {
        $devs = ['allweb','android','ios'];
        if ($devices == 'all') {
            $traffics = DB::table('ga_traffics')
                ->select(DB::raw('avg(visitors) as visitors,avg(pageviews) as pageviews'))
                //->whereIn('devices', $devs)
                ->where('channels', $channels)
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->get();
        } else {
            $traffics = DB::table('ga_traffics')
                ->select(DB::raw('avg(visitors) as visitors,avg(pageviews) as pageviews'))
                ->where('devices', $devices)
                ->where('channels', $channels)
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->get();
        }

        $dataTraffic = [];
        foreach ($traffics as $data) {
            array_push($dataTraffic, [
                'visitors' => round($data->visitors),
                'pageviews' => round($data->pageviews),
            ]);
        }

        return $dataTraffic;
    }

    public function traffics(Request $request)
    {
        $QueryString = $request->query->all();
        if (count($QueryString) <= 0) {
			$url = $request->url();
			$start = Carbon::now()->subdays(6)->format('Y-m-d');
			$end = Carbon::now()->subdays(1)->format('Y-m-d');
			$params = [
				'platform' => 'all',
				'start' => $start,
				'end' => $end,
				'channels[]' => 'all'
			];
			$request->merge($params);
			$redirectUrl = $url.'?'.http_build_query($request->query());
			return redirect($redirectUrl);
        } else {
			$excludes = [
				'20detik' => '20Detik',
				'forum' => 'Forum'
			];
			if (($request->input('platform') == 'android') || ($request->input('platform') == 'ios')) {
				$channels = array_diff(config('detik.channels'), $excludes);
			} else {
				$channels = config('detik.channels');
			}
            
			$dataTraffics = $this->TrafficsData($request);
			return view('traffics::dailytraffics',
				[
					'channels' => $channels,
					'tabsData' => $dataTraffics['tabsData'],
					'avgsData' => $dataTraffics['avgsData'],
					'arrayChannels' => $dataTraffics['arrayChannels'],
					'avgChannels' => $dataTraffics['avgChannels']
				]
			);
		}
    }

    public function TrafficsData(Request $request)
    {   
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platformVar = $request->input('platform');
            $channelVar = $request->input('channels');
			
            $arrayChannels = [];
            $avgChannels = [];
            $tabsData = [];
            $avgsData = [];
            $tabs = 1;
            foreach($channelVar as $channel) {
                $datachannel = $channel.'Data';
                $avgchannel = $channel.'Avg';
				$channelcolor = ChannelColor::channelRgba($channel);
                ${$datachannel} = $this->getTraffics(
                    $startDate,
                    $endDate,
                    $platformVar,
                    $channel
                );
                $arrayChannels[$datachannel] = ${$datachannel};
                
                ${$avgchannel} = $this->getAvgTraffics(
                    $startDate,
                    $endDate,
                    $platformVar,
                    $channel
                );
                $avgChannels[$avgchannel] = ${$avgchannel};

                $tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data', $channelcolor];
                $avgsData['tabs-'.$tabs] = [ucwords($channel), $avgchannel];
                $tabs++;
            } 

            return [
                'tabsData' => $tabsData,
                'avgsData' => $avgsData,
                'arrayChannels' => $arrayChannels,
                'avgChannels' => $avgChannels
            ];
        } else {
            echo "Bad request!";
            exit();
        }
    }
    // End: Daily Traffics

    // Start: Monthly Traffcis
    public function getMonthlyTraffics(String $startMonth, String $endMonth, String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
			$devs = ['allweb','android','ios'];
			$traffics = DB::table('ga_monthlytraffics')
                ->select(DB::raw('monthYear,year,sum(visitors) as visitors,sum(pageviews) as pageviews,channels'))
                ->whereIn('devices', $devs)
                ->where('channels', $channels)
                ->where('monthYear', '>=', $startMonth)
                ->where('monthYear', '<=', $endMonth)
				->where('year', '>=', $startYear)
				->where('year', '<=', $endYear)
                ->groupBy('monthYear')
				->orderBy('year', 'ASC')
                ->orderBy('monthYear', 'ASC')
                ->get();

        } else {
            $traffics = DB::table('ga_monthlytraffics')
                ->select(
                    'monthYear', 
                    'year', 
                    'devices', 
                    'channels', 
                    'visitors',
                    'pageviews')
                ->where('devices', $devices)
                ->where('channels', $channels)
                ->where('monthYear', '>=', $startMonth)
                ->where('monthYear', '<=', $endMonth)
                ->where('year', '>=', $startYear)
                ->where('year', '<=', $endYear)
                ->groupBy('monthYear','year')
                ->orderBy('year', 'ASC')
                ->orderBy('monthYear', 'ASC')
                ->get();
        }
		
        $dataTraffic = [];
        $cnt = 1;
        $diffVisitors = '-';
        $diffPageviews = '-';
        $semVisitors = 0;
        $semPageviews = 0;
        foreach ($traffics as $data) {
            if ($cnt > 1) {
                if ($SemVisitors == 0)
                    $diffVisitors = ($data->visitors - $SemVisitors) * 100;
                else
                    $diffVisitors = round((($data->visitors - $SemVisitors)/$SemVisitors), 2) * 100;
                if ($semPageviews == 0)
                    $diffPageviews = ($data->pageviews - $semPageviews) * 100;
                else
                    $diffPageviews = round((($data->pageviews - $semPageviews)/$semPageviews), 2) * 100;
            }
            else {
                $diffVisitors = '-';
                $diffPageviews = '-';
            }

            array_push($dataTraffic, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName($data->monthYear),
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'diffVisitors' => $diffVisitors,
                'diffPageviews' => $diffPageviews
            ]);

            $SemVisitors = $data->visitors;
            $semPageviews = $data->pageviews;
            $cnt++;
        }
		
        return $dataTraffic;
    }

    public function averageMonthlyTraffics(String $startMonth, String $endMonth, String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
			$devs = ['allweb','android','ios'];
            $traffics = DB::table('ga_monthlytraffics')
                ->select(
                    'monthYear', 
                    'year', 
                    'devices', 
                    'channels', 
                    DB::raw('avg(visitors) as visitors'),
                    DB::raw('avg(pageviews) as pageviews'))
                //->whereIn('devices', $devs)
                ->where('channels', $channels)
                ->where('monthYear', '>=', $startMonth)
                ->where('monthYear', '<=', $endMonth)
                ->where('year', '>=', $startYear)
                ->where('year', '<=', $endYear)
                ->orderBy('year', 'ASC')
                ->orderBy('monthYear', 'ASC')
                ->get();
        } else {
            $traffics = DB::table('ga_monthlytraffics')
                ->select(
                    'monthYear', 
                    'year', 
                    'devices', 
                    'channels', 
                    DB::raw('avg(visitors) as visitors'),
                    DB::raw('avg(pageviews) as pageviews'))
                ->where('devices', $devices)
                ->where('channels', $channels)
                ->where('monthYear', '>=', $startMonth)
                ->where('monthYear', '<=', $endMonth)
                ->where('year', '>=', $startYear)
                ->where('year', '<=', $endYear)
                ->orderBy('year', 'ASC')
                ->orderBy('monthYear', 'ASC')
                ->get();
        }
        $dataTraffic = [];
        $cnt = 1;
        $diffVisitors = '-';
        $diffPageviews = '-';
        $semVisitors = 0;
        $semPageviews = 0;
        foreach ($traffics as $data) {
            if ($cnt > 1) {
                if ($SemVisitors == 0)
                    $diffVisitors = ($data->visitors - $SemVisitors) * 100;
                else
                    $diffVisitors = round((($data->visitors - $SemVisitors)/$SemVisitors), 2) * 100;
                if ($semPageviews == 0)
                    $diffPageviews = ($data->pageviews - $semPageviews) * 100;
                else
                    $diffPageviews = round((($data->pageviews - $semPageviews)/$semPageviews), 2) * 100;
            }
            else {
                $diffVisitors = '-';
                $diffPageviews = '-';
            }

            array_push($dataTraffic, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName((string)$data->monthYear),
                'visitors' => round($data->visitors),
                'pageviews' => round($data->pageviews),
                'diffVisitors' => $diffVisitors,
                'diffPageviews' => $diffPageviews
            ]);

            $SemVisitors = $data->visitors;
            $semPageviews = $data->pageviews;
            $cnt++;
        }
        return $dataTraffic;
    }

    public function monthlyTraffics(Request $request)
    {
        $QueryString = $request->query->all();
        if (count($QueryString) <= 0) {
            $url = $request->url();
            $start = Carbon::now()->submonths(5)->format('Y-m-d');
            $end = Carbon::now()->submonths(1)->format('Y-m-d');
            $params = [
                'platform' => 'all',
                'start' => $start,
                'end' => $end,
                'channels[]' => 'all'
            ];
            $request->merge($params);
            $redirectUrl = $url.'?'.http_build_query($request->query());
            return redirect($redirectUrl);
        } else {
			$excludes = [
				'20detik' => '20Detik',
				'forum' => 'Forum'
			];
			if (($request->input('platform') == 'android') || ($request->input('platform') == 'ios')) {
				$channels = array_diff(config('detik.channels'), $excludes);
			} else {
				$channels = config('detik.channels');
			}
			
			$dataTraffics = $this->monthlyTrafficsData($request);
            return view('traffics::monthlytraffics',
                [
                    'channels' => $channels,
                    'tabsData' => $dataTraffics['tabsData'],
                    'avgsData' => $dataTraffics['avgsData'],
                    'arrayChannels' => $dataTraffics['arrayChannels'],
                    'avgChannels' => $dataTraffics['avgChannels']
                ]
            );
        }
    }

    public function monthlyTrafficsData(Request $request)
    {   
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platformVar = $request->input('platform');
            $channelVar = $request->input('channels');

            $arrayChannels = [];
            $avgChannels = [];
            $tabsData = [];
            $avgsData = [];
            $tabs = 1;
            $avgs = 1;
            foreach($channelVar as $channel) {
                $datachannel = $channel.'Data';
                $avgchannel = 'avg'.$channel.'Data';
				$channelcolor = ChannelColor::channelRgba($channel);
                ${$datachannel} = $this->getMonthlyTraffics(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                $arrayChannels[$datachannel] = ${$datachannel};

                ${$avgchannel} = $this->averageMonthlyTraffics(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                $avgChannels[$avgchannel] = ${$avgchannel};

                $tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data', $channelcolor];
                $avgsData['avgs-'.$avgs] =  [ucwords($channel), $avgchannel];
                $tabs++;
                $avgs++;
            } 

			return [
				'tabsData' => $tabsData,
                'avgsData' => $avgsData,
                'arrayChannels' => $arrayChannels,
                'avgChannels' => $avgChannels
			];
        } else {
            echo "Bad request!";
        }
    }
	// End: Monthly Traffcis
	
	// Start: Monthly Daily Average
    public function getAvgDailyTraffics(String $startMonth, String $endMonth, String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android','ios'];
            $traffics = DB::table('ga_traffics')
                ->select(DB::raw('monthYear,year,avg(visitors) as visitors,avg(pageviews) as pageviews,channels'))
                ->whereIn('devices', $devs)
                ->where('channels', $channels)
                ->where('monthYear', '>=', $startMonth)
                ->where('monthYear', '<=', $endMonth)
                ->where('year', $startYear)
                ->where('year', '<=', $endYear)
                ->groupBy('monthYear')
                ->orderBy('year', 'ASC')
                ->orderBy('monthYear', 'ASC')
                ->get();

        } else {
            $traffics = DB::table('ga_traffics')
                ->select(DB::raw('monthYear,year,avg(visitors) as visitors,avg(pageviews) as pageviews,channels'))
                ->where('devices', $devices)
                ->where('channels', $channels)
                ->where('monthYear', '>=', $startMonth)
                ->where('monthYear', '<=', $endMonth)
                ->where('year', '>=', $startYear)
                ->where('year', '<=', $endYear)
                ->groupBy('monthYear','year')
                ->orderBy('year', 'ASC')
                ->orderBy('monthYear', 'ASC')
                ->get();
        }
        
        $dataTraffic = [];
        $cnt = 1;
        $diffVisitors = '-';
        $diffPageviews = '-';
        $semVisitors = 0;
        $semPageviews = 0;
        foreach ($traffics as $data) {
            if ($cnt > 1) {
                if ($SemVisitors == 0)
                    $diffVisitors = ($data->visitors - $SemVisitors) * 100;
                else
                    $diffVisitors = round((($data->visitors - $SemVisitors)/$SemVisitors), 2) * 100;
                if ($semPageviews == 0)
                    $diffPageviews = ($data->pageviews - $semPageviews) * 100;
                else
                    $diffPageviews = round((($data->pageviews - $semPageviews)/$semPageviews), 2) * 100;
            }
            else {
                $diffVisitors = '-';
                $diffPageviews = '-';
            }

            array_push($dataTraffic, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName((string)$data->monthYear),
                'visitors' => round($data->visitors, 0),
                'pageviews' => round($data->pageviews, 0),
                'diffVisitors' => $diffVisitors,
                'diffPageviews' => $diffPageviews
            ]);

            $SemVisitors = $data->visitors;
            $semPageviews = $data->pageviews;
            $cnt++;
        }
        
        return $dataTraffic;
    }

    public function avgDailyTrafficsData(Request $request)
    {   
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
            
            $platformVar = $request->input('platform');
            $channelVar = $request->input('channels');

            $arrayChannels = [];
            $tabsData = [];
            $tabs = 1;
            foreach($channelVar as $channel) {
                $datachannel = $channel.'Data';
				$channelcolor = ChannelColor::channelRgba($channel);
                ${$datachannel} = $this->getAvgDailyTraffics(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                $arrayChannels[$datachannel] = ${$datachannel};

                $tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data', $channelcolor];
                $tabs++;
            } 
			
            return [
                'tabsData' => $tabsData,
                'arrayChannels' => $arrayChannels,
            ];
        } else {
            echo "Bad request!";
        }
    }

    public function avgDailyTraffics(Request $request)
    {
        $QueryString = $request->query->all();
        if (count($QueryString) <= 0) {
            $url = $request->url();
            $start = Carbon::now()->submonths(5)->format('Y-m-d');
            $end = Carbon::now()->submonths(1)->format('Y-m-d');
            $params = [
                'platform' => 'all',
                'start' => $start,
                'end' => $end,
                'channels[]' => 'all'
            ];
            $request->merge($params);
            $redirectUrl = $url.'?'.http_build_query($request->query());
            return redirect($redirectUrl);
        } else {
            $excludes = [
                '20' => '20Detik',
                'forum' => 'Forum'
            ];
            if (($request->input('platform') == 'android') || ($request->input('platform') == 'ios')) {
                $channels = array_diff(config('detik.channels'), $excludes);
            } else {
                $channels = config('detik.channels');
            }
            
            $dataTraffics = $this->avgDailyTrafficsData($request);
            return view('traffics::dailyaverage',
                [
                    'channels' => $channels,
                    'tabsData' => $dataTraffics['tabsData'],
                    'arrayChannels' => $dataTraffics['arrayChannels'],
                ]
            );
        }
    }
    // End: Monthly Daily Average

}
