<?php

namespace Modules\Achievement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

// Self Added
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use App\Helpers\MonthName;
use App\Helpers\ChannelColor;
use Modules\Traffics\Entities\DailyTraffics;
use Modules\Achievement\Entities\AchievementTarget;

class AchievementController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
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
				'wp' => 'Welcome page',
				'20detik' => '20Detik',
				'x' => 'XDetik',
				'forum' => 'Forum'
			];
			/*if (($request->input('platform') == 'android') || ($request->input('platform') == 'ios')) {
				$channels = array_diff(config('detik.channels'), $excludes);
			} else {
				$channels = config('detik.channels');
			}*/
			$channels = array_diff(config('detik.channels'), $excludes);
			
			$dataTraffics = $this->achievementResult($request);
            return view('achievement::achievement',
                [
                    'channels' => $channels,
                    'tabsData' => $dataTraffics['tabsData'],
                    'arrayChannels' => $dataTraffics['arrayChannels'],
                ]
            );
        }
    }

	// Start: Get Target Value By Year & Channel
	protected function targetByChannel(String $year, String $channels)
	{
		$target = [];
		$getTarget = AchievementTarget::select('uvtarget','pvtarget')
			->where('year', $year)
			->where('channel', $channels)
			->first();
		$target['uv'] = $getTarget->uvtarget;
		$target['pv'] = $getTarget->pvtarget;
		
		return $target;
	}
	// End: Get Target Value By Year & Channel
	
	// Start: Monthly Daily Average
    public function getAvgDailyTraffics(String $startMonth, String $endMonth, String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android','ios'];
            $traffics = DailyTraffics::selectRaw(
					'monthYear,
					year,
					avg(visitors) as visitors,
					avg(pageviews) as pageviews,
					channels')
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
            $traffics = DailyTraffics::selectRaw(
                    'monthYear, 
                    year, 
                    devices, 
                    channels, 
                    avg(visitors) as visitors,
                    avg(pageviews) as pageviews')
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
        foreach ($traffics as $data) {
			$dataTarget = $this->targetByChannel($data->year, $data->channels);		
            array_push($dataTraffic, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName($data->monthYear),
                'visitors' => round($data->visitors / $dataTarget['uv'], 2, PHP_ROUND_HALF_UP) * 100,
                'pageviews' => round($data->pageviews / $dataTarget['pv'], 2, PHP_ROUND_HALF_UP) * 100,
            ]);
        }
        
        return $dataTraffic;
    }
	//End: Monthly Daily Average
	
	// Start: Achievement Calculate
	public function achievementResult(Request $request)
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
				'arrayChannels' => $arrayChannels
			];
			
		} else {
            echo "Bad request!";
        }
		// End: Achievement Calculate
	}
}
