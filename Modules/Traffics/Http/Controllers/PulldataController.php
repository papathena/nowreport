<?php

namespace Modules\Traffics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Traffics\Entities\DailyTraffics;
use Modules\Traffics\Entities\MonthlyTraffics;
use Modules\Traffics\Helpers\TrafficHelper;
Use Carbon\Carbon;
use Spatie\Analytics\Period;

class PulldataController extends Controller
{

	// B: Daily Pulling Data
	protected function dailyStore(
		String $date,
		String $dayDate,
		String $dayName,
		String $weekYear,
		String $monthYear,
		String $year,
		string $devices,
		String $channels,
		int $visitors,
		int $pageviews)
	{
		$gatraffics = new DailyTraffics();
		$gatraffics->date = $date;
		$gatraffics->dayDate = $dayDate;
		$gatraffics->dayName = $dayName;
		$gatraffics->weekYear = $weekYear;
		$gatraffics->monthYear = $monthYear;
		$gatraffics->year = $year;
		$gatraffics->devices = $devices;
		$gatraffics->channels = $channels;
		$gatraffics->visitors = $visitors;
		$gatraffics->pageviews = $pageviews;
		$gatraffics->save();
	}
	
	protected function dailyUpdate(
        String $date,
        String $devices,
        String $channels,
        int $visitors,
        int $pageviews)
    {
        $gatraffics = DailyTraffics::where([
            'date' => $date,
            'devices' => $devices,
            'channels' => $channels
        ])->update([
            'visitors' => $visitors,
                'pageviews' => $pageviews
        ]);
    }
	
	protected function dailyHasData(String $dates, String $devices, String $channels)
    {
        $datas = DailyTraffics::where([
            'date' => $dates,
            'devices' => $devices,
            'channels' => $channels
        ])->first();
        if (is_null($datas))
			return false;
        else
		   return true;
    }

	protected function dailyLessData(
        String $dates,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews)
    {
        $datas = DailyTraffics::where([
            'date' => $dates,
            'devices' => $devices,
            'channels' => $channels,
        ])->first();
        if (($datas['pageviews'] < $pageviews) || ($datas['visitors'] < $visitors))
            return true;
        else
            return false;
    }
	
	public function dailyGetData(Period $period, String $platform, String $devices, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TrafficHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTraffics($period, $devices, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTraffics($period, $devices, $channels, $filters);
                break;
            default : $data = $getQuery->webTraffics($period, $devices, $channels, $filters);
        }
        return $data[0];
    }
	
	public function dailyPushData($data)
    {
        $this->dailyStore(
            $data['date'],
            $data['dayDate'],
            $data['dayName'],
            $data['weekYear'],
            $data['monthYear'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews']
        );
    }
	
	public function dailyUpdateData($data)
    {
        $this->dailyUpdate(
            $data['date'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews']
        );
    }
	
	public function dailyPull(Request $request)
    {
        if ($request->isMethod('get')) {		
			$platform = $request->input('platform');
            $channel = $request->input('channel');

            if (is_null($request->input('start')) || is_null($request->input('end'))) {
                $startDate = Carbon::parse(Carbon::now()->subWeeks(1)->format('Y-m-d'));
                $endDate = Carbon::parse(Carbon::now()->format('Y-m-d'));
            } else {
                $startDate = Carbon::parse($request->input('start'));
                $endDate = Carbon::parse($request->input('end'));
            }
			
            $websites = config('detik.web');
            $lenDays = $endDate->diffInDays($startDate);
            for ($a=0; $a<=$lenDays; $a++) {
                echo '>>>> TGL '.$startDate.' <<<<'."\n";
                $period = new Period($startDate, $startDate);
                if ($platform == 'web') {
                    $filters = config('detik.'.$channel);
                    foreach ($websites as $key => $devices) {
                        $webTraffic = $this->dailyGetData(
                            $period,
                            $platform,
                            $key,
                            $channel,
                            $filters[$devices]
                        );
						echo 'Filter Query: '. $filters[$devices] . "\n";
                        if (!$this->dailyHasData($webTraffic['date'],$key,$channel)) {
                            echo 'Push data '. $webTraffic['date'].' '.$key.' '.$channel.' '.$webTraffic['visitors'].' '.$webTraffic['pageviews']."\n";
                            $this->dailyPushData($webTraffic);
                        } elseif ($this->dailyLessData($webTraffic['date'],$key,$channel, $webTraffic['visitors'], $webTraffic['pageviews'])) {
                            echo 'Update data '.$webTraffic['date'].' '.$key.' '.$channel.' '.$webTraffic['visitors'].' '.$webTraffic['pageviews']."\n";
                            $this->dailyUpdateData($webTraffic);
                        } else {
                            echo 'Data '.$webTraffic['date'].' '.$key.' '.$channel.' OK'."\n";
                        }
                    }
                } else {
                    $filter_idx = str_replace($platform, 'apps_', $platform) . $channel;
                    $filters = config('detik.'.$filter_idx);
                    $appsTraffic = $this->dailyGetData(
                        $period,
                        $platform,
                        $platform,
                        $channel,
                        $filters

                    );
					echo 'Filter Query: '. $filters . "\n";
                    if (!$this->dailyHasData($appsTraffic['date'],$platform,$channel)) {
                        echo 'Push data '. $appsTraffic['date'].' '.$platform." ". $channel.' '.$appsTraffic['visitors'].' '.$appsTraffic['pageviews']."\n";
                        $this->dailyPushData($appsTraffic);
                    } elseif ($this->dailyLessData($appsTraffic['date'],$platform,$channel, $appsTraffic['visitors'], $appsTraffic['pageviews'])) {
                        echo 'Update data '.$appsTraffic['date'].' '.$platform." ". $channel.' '.$appsTraffic['visitors'].' '.$appsTraffic['pageviews']."\n";
                        $this->dailyUpdateData($appsTraffic);
                    } else {
                        echo 'Data '.$appsTraffic['date'].' '.$platform." ". $channel.' OK'."\n";
                    }
                }
                $startDate->addDay();
            }
        } else {
                echo "Bad Request!!!";
        }
    }
	// E: Daily Pulling Data
	
    // B: Monthly Pulling Data
    Protected function monthlyStore(
        String $monthYear,
        String $year, 
        string $devices, 
        String $channels,
        int $visitors, 
        int $pageviews)
    {
        $gatraffics = new MonthlyTraffics();
        $gatraffics->monthYear = $monthYear;
        $gatraffics->year = $year;
        $gatraffics->devices = $devices;
        $gatraffics->channels = $channels;
        $gatraffics->visitors = $visitors;
        $gatraffics->pageviews = $pageviews;
        $gatraffics->save();
    }

    protected function monthlyUpdate(
        String $month,
        String $year,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews)
    {
        $gatraffics = MonthlyTraffics::where([
            'monthYear' => $month,
            'year' => $year,
            'devices' => $devices,
            'channels' => $channels
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews
        ]);
    }

    protected function monthlyHasData(String $month, String $year, String $devices, String $channels)
    {
        $datas = MonthlyTraffics::where([
            'monthYear' => $month, 
            'year' => $year,
            'devices' => $devices, 
            'channels' => $channels
        ])->first();
        if (is_null($datas))
            return false;
        else 
            return true;
    }

    protected function monthlyLessData(
        String $month,
        String $year, 
        String $devices, 
        String $channels,
        Int $visitors,
        Int $pageviews)
    {
        $datas = MonthlyTraffics::where([
            'monthYear' => $month,
            'year' => $year, 
            'devices' => $devices, 
            'channels' => $channels,
        ])->first();
        if (($datas['pageviews'] < $pageviews) || ($datas['visitors'] < $visitors)) 
            return true;
        else
            return false;
    }

    public function monthlyGetData(Period $period, String $platform, String $devices, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TrafficHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTrafficsMonthly($period, $devices, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTrafficsMonthly($period, $devices, $channels, $filters);
                break;
            default : $data = $getQuery->webTrafficsMonthly($period, $devices, $channels, $filters);
        }
        return $data[0];
    }

    public function monthlyPushData($data)
    {
        $this->monthlyStore(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews']
        );
    }

    public function monthlyUpdateData($data)
    {
        $this->monthlyUpdate(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews']
        );
    }

    public function monthlyPull(Request $request)
    {
        if ($request->isMethod('get')) {
            $platform = $request->input('platform');
            $channel = $request->input('channel');
            if (is_null($request->input('start')) || is_null($request->input('end'))) {
                $startDate = Carbon::parse(Carbon::now()->subMonths(2)->format('Y-m-d'));
                $endDate = Carbon::parse(Carbon::now()->format('Y-m-d'));
            } else {
                $startDate = Carbon::parse($request->input('start'));
                $endDate = Carbon::parse($request->input('end'));
            }

            $websites = config('detik.web');
            $lenMonths = $endDate->diffInmonths($startDate);
            for ($a=0; $a<=$lenMonths; $a++) {
                echo '>>>> Month '.$startDate->format('F').' <<<<'."\n";
                $period = new Period($startDate, $endDate);
                if ($platform == 'web') {
                    $filters = config('detik.'.$channel);
                    foreach ($websites as $key => $devices) {
                        $webTraffic = $this->monthlyGetData(
                            $period,
                            $platform,
                            $key,
                            $channel,
                            $filters[$devices]
                        );
                        
						echo 'Filter Query: '. $filters[$devices] . "\n";
                        if (!$this->monthlyHasData($webTraffic['month'],$webTraffic['year'],$webTraffic['devices'],$webTraffic['channels'])) {
                            echo 'Push data '. $webTraffic['month'].' '.$webTraffic['year'].' '.$webTraffic['devices'].' '.$webTraffic['channels'].' '.$webTraffic['visitors'].' '.$webTraffic['pageviews']."\n";
                            $this->monthlyPushData($webTraffic);
                        } elseif ($this->monthlyLessData($webTraffic['month'],$webTraffic['year'],$webTraffic['devices'],$webTraffic['channels'],$webTraffic['visitors'], $webTraffic['pageviews'])) {
                            echo 'Update data '.$webTraffic['month'].' '.$key.' '.$channel."\n";
                            $this->monthlyUpdateData($webTraffic);
                        } else {
                            echo 'Data '.$webTraffic['month'].' '.$key.' '.$channel.' OK'."\n";    
                        }
                    }
                } else {
                    $filter_idx = str_replace($platform, 'apps_', $platform) . $channel;
                    $filters = config('detik.'.$filter_idx);
                    $appsTraffic = $this->monthlyGetData(
                        $period,
                        $platform,
                        $platform,
                        $channel,
                        $filters
                    );

					echo 'Filter Query: '. $filters . "\n";
                    if (!$this->monthlyHasData($appsTraffic['month'],$appsTraffic['year'],$appsTraffic['devices'],$appsTraffic['channels'])) {
						echo 'Push data '. $appsTraffic['month'].' '.$appsTraffic['year'].' '.$appsTraffic['devices'].' '.$appsTraffic['channels'].' '.$appsTraffic['visitors'].' '.$appsTraffic['pageviews']."\n";
						$this->monthlyPushData($appsTraffic);
					} elseif ($this->monthlyLessData($appsTraffic['month'],$appsTraffic['year'],$platform,$channel, $appsTraffic['visitors'], $appsTraffic['pageviews'])) {
                        echo 'Update data '.$appsTraffic['month'].' '.$platform." ". $channel."\n";
                        $this->monthlyUpdateData($appsTraffic);
                    } else {
                        echo 'Data '.$appsTraffic['month'].' '.$platform." ". $channel.' OK'."\n";
                    }
                }
                $startDate->addMonth();
            }
        } else {
            echo "Bad Request!!!";
        }
    }

   // E: Monthly Pulling Data
 
}
