<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\MonthlyTopArticles;
use Modules\TopArticles\Entities\MonthlyTopNewsArticles;
use Modules\TopArticles\Entities\MonthlyTopPhotoArticles;
use Modules\TopArticles\Entities\MonthlyTopPushArticles;
use App\Helpers\MonthName;

class MonthlyTopArticlesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function monthlyTopArticles(Request $request)
	{
		$QueryString = $request->query->all();
        if (count($QueryString) <= 0) {
            $url = $request->url();
            $start = Carbon::now()->submonths(5)->format('Y-m-d');
            $end = Carbon::now()->submonths(1)->format('Y-m-d');
            $params = [
                'platform' => 'allweb',
                'start' => $start,
                'end' => $end,
                'channels' => 'all'
            ];
            $request->merge($params);
            $redirectUrl = $url.'?'.http_build_query($request->query());
            return redirect($redirectUrl);
        } else {
            $excludes = [
				'wp' => 'Welcome page',
                '20detik' => '20Detik',
                'forum' => 'Forum'
            ];
			$channels = array_diff(config('top10articles.channels'), $excludes);
			$allTopArticles = $this->topArticlesData($request);
            $newsTopArticles = $this->topNewsArticlesData($request);
            $photoTopArticles = $this->topPhotoArticlesData($request);
            $pushTopArticles = $this->topPushArticlesData($request);
			
			return view('toparticles::monthlytoparticles', [
                'channels' => $channels,
				'allTopArticles' => $allTopArticles,
				//'allTabs' => $allTopArticles['tabsData'],
                'newsTopArticles' => $newsTopArticles,
				//'newsTabs' => $newsTopArticles['tabsData'],
                'photoTopArticles' => $photoTopArticles,
				//'photoTabs' => $photoTopArticles['tabsData'],
                'pushTopArticles' => $pushTopArticles,
				//'pushTabs' => $pushTopArticles['tabsData']
			]);
		}
	}
	
	// B: Get all Top 10 articles
	public function getTopArticles(String $startMonth, String $endMonth,  String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
			$devs = ['allweb','android','ios'];
            if ($channels == 'all') {
                $toparticles = MonthlyTopArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        } else {
            if ($channels == 'all') {
                $toparticles = MonthlyTopArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($toparticles as $data) {
            array_push($dataToparticle, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName($data->monthYear),
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
    }
	// E: Get all Top 10 articles
	
	// B: All Top 10 articles data
	public function topArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platformVar = $request->input('platform');
            $channel = $request->input('channels');

            //$arrayChannels = [];
            //$tabsData = [];
            //$tabs = 1;
			$datachannel = [];
            //foreach($channelVar as $channel) {
                //$datachannel = $channel.'Data';
                $datachannel = $this->getTopArticles(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                //$arrayChannels[$datachannel] = ${$datachannel};
                //$tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data'];
                //$tabs++;
            //}
			
            /*return [
                'tabsData' => $tabsData,
                'arrayChannels' => $arrayChannels
            ];*/
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: All Top 10 articles data

	// B: Get news Top 10 articles
	public function getTopNewsArticles(String $startMonth, String $endMonth,  String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
			$devs = ['allweb','android','ios'];
            if ($channels == 'all') {
                $toparticles = MonthlyTopNewsArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopNewsArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        } else {
            if ($channels == 'all') {
                $toparticles = MonthlyTopNewsArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopNewsArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($toparticles as $data) {
            array_push($dataToparticle, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName($data->monthYear),
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
    }
	// E: Get news Top 10 articles
	
	// B: News Top 10 articles data
	public function topNewsArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platformVar = $request->input('platform');
            //$channelVar = $request->input('channels');
            $channel = $request->input('channels');
	
            //$arrayChannels = [];
            //$tabsData = [];
            //$tabs = 1;
			$datachannel = [];
            //foreach($channelVar as $channel) {
                //$datachannel = $channel.'Data';
                $datachannel = $this->getTopNewsArticles(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                //$arrayChannels[$datachannel] = ${$datachannel};
                //$tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data'];
                //$tabs++;
            //}
			
            /*return [
                'tabsData' => $tabsData,
                'arrayChannels' => $arrayChannels
            ];*/
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: News Top 10 articles data

	// B: Get photo Top 10 articles
	public function getTopPhotoArticles(String $startMonth, String $endMonth,  String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
			$devs = ['allweb','android','ios'];
            if ($channels == 'all') {
                $toparticles = MonthlyTopPhotoArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopPhotoArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        } else {
            if ($channels == 'all') {
                $toparticles = MonthlyTopPhotoArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopPhotoArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($toparticles as $data) {
            array_push($dataToparticle, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName($data->monthYear),
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
    }
	// E: Get photo Top 10 articles
	
	// B: Photo Top 10 articles data
	public function topPhotoArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platformVar = $request->input('platform');
            //$channelVar = $request->input('channels');
            $channel = $request->input('channels');

            //$arrayChannels = [];
            //$tabsData = [];
            //$tabs = 1;
			$datachannel = [];
            //foreach($channelVar as $channel) {
                //$datachannel = $channel.'Data';
                $datachannel = $this->getTopPhotoArticles(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                //$arrayChannels[$datachannel] = ${$datachannel};
                //$tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data'];
                //$tabs++;
            //}
			
            /*return [
                'tabsData' => $tabsData,
                'arrayChannels' => $arrayChannels
            ];*/
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: Photo Top 10 articles data

	// B: Get push notification Top 10 articles
	public function getTopPushArticles(String $startMonth, String $endMonth,  String $startYear, String $endYear, String $devices, String $channels)
    {
        if ($devices == 'all') {
			$devs = ['allweb','android','ios'];
            if ($channels == 'all') {
                $toparticles = MonthlyTopPushArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopPushArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->whereIn('devices', $devs)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        } else {
            if ($channels == 'all') {
                $toparticles = MonthlyTopPushArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '!=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            } else {
                $toparticles = MonthlyTopPushArticles::select('monthYear','year','pageviews','visitors','devices','channels','pagetitle')
                        ->where('devices', $devices)
                        ->where('channels', '=', $channels)
                        ->where('monthYear', '>=', $startMonth)
                        ->where('monthYear', '<=', $endMonth)
                        ->where('year', '>=', $startYear)
                        ->where('year', '<=', $endYear)
                        ->orderBy('visitors', 'DESC')
                        ->take(10)
                        ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($toparticles as $data) {
            array_push($dataToparticle, [
                'month' => $data->monthYear,
                'year' => $data->year,
                'monthName' => MonthName::monthName($data->monthYear),
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
    }
	// E: Get push notification Top 10 articles
	
	// B: Push notification Top 10 articles data
	public function topPushArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platformVar = $request->input('platform');
            //$channelVar = $request->input('channels');
            $channel = $request->input('channels');

            //$arrayChannels = [];
            //$tabsData = [];
            //$tabs = 1;
			$datachannel = [];
            //foreach($channelVar as $channel) {
                //$datachannel = $channel.'Data';
                $datachannel = $this->getTopPushArticles(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platformVar,
                    $channel
                );
                //$arrayChannels[$datachannel] = ${$datachannel};
                //$tabsData['tabs-'.$tabs] =  [ucwords($channel), $channel.'Data'];
                //$tabs++;
            //}
			
            /*return [
                'tabsData' => $tabsData,
                'arrayChannels' => $arrayChannels
            ];*/
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: Push notification Top 10 articles data
	
}
