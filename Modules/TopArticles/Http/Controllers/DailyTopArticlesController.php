<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\DailyTopArticles;
use Modules\TopArticles\Entities\DailyTopNewsArticles;
use Modules\TopArticles\Entities\DailyTopPhotoArticles;
use Modules\TopArticles\Entities\DailyTopPushArticles;

class DailyTopArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dailyTopArticles(Request $request)
    {
        $QueryString = $request->query->all();
        if (count($QueryString) <= 0) {
            $url = $request->url();
            $start = Carbon::now()->subdays(6)->format('Y-m-d');
            $end = Carbon::now()->subdays(1)->format('Y-m-d');
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
			
            return view('toparticles::dailytoparticles', [
                'channels' => $channels,
                'allTopArticles' => $allTopArticles,
                'newsTopArticles' => $newsTopArticles,
                'photoTopArticles' => $photoTopArticles,
                'pushTopArticles' => $pushTopArticles,
            ]);
        }
    }

    // B: Get all Top 10 articles
    public function getTopArticles(String $startDate, String $endDate, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android', 'ios'];
            if ($channels == 'all') {
                $maxrow = DailyTopArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        } else {
            if ($channels == 'all') {
                $maxrow = DailyTopArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($maxrow as $data) {
            array_push($dataToparticle, [
                'date' => Carbon::parse($data->date)->format('d-m-Y'),
                'pageviews' => $data->pageviews,
                'visitors' => $data->visitors,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle
            ]);

        }
		
        return $dataToparticle;
    }
    // E: Get all Top 10 articles

    // B: All Top 10 articles data
    public function topArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platformVar = $request->input('platform');
            $channel = $request->input('channels');

			$datachannel = [];
			$datachannel = $this->getTopArticles(
				$startDate,
				$endDate,
				$platformVar,
				$channel
			);
				
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: All Top 10 articles data

    // B: Get news Top 10 articles
    public function getTopNewsArticles(String $startDate, String $endDate, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android', 'ios'];
            if ($channels == 'all') {
                $maxrow = DailyTopNewsArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopNewsArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        } else {
            if ($channels == 'all') {
                $maxrow = DailyTopNewsArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopNewsArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($maxrow as $data) {
            array_push($dataToparticle, [
                'date' => Carbon::parse($data->date)->format('d-m-Y'),
                'pageviews' => $data->pageviews,
                'visitors' => $data->visitors,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle
            ]);

        }
		
        return $dataToparticle;
    }
    // E: Get news Top 10 articles

    // B: News Top 10 articles data
    public function topNewsArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platformVar = $request->input('platform');
            $channel = $request->input('channels');
			
			$datachannel = [];
			$datachannel = $this->getTopNewsArticles(
				$startDate,
				$endDate,
				$platformVar,
				$channel
			);
				
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: News Top 10 articles data

    // B: Get photo Top 10 articles
    public function getTopPhotoArticles(String $startDate, String $endDate, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android', 'ios'];
            if ($channels == 'all') {
                $maxrow = DailyTopPhotoArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopPhotoArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        } else {
            if ($channels == 'all') {
                $maxrow = DailyTopPhotoArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopPhotoArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($maxrow as $data) {
            array_push($dataToparticle, [
                'date' => Carbon::parse($data->date)->format('d-m-Y'),
                'pageviews' => $data->pageviews,
                'visitors' => $data->visitors,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle
            ]);

        }
		
        return $dataToparticle;
    }
    // E: Get photo Top 10 articles

    // B: Photo Top 10 articles data
    public function topPhotoArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platformVar = $request->input('platform');
            $channel = $request->input('channels');
			
			$datachannel = [];
			$datachannel = $this->getTopPhotoArticles(
				$startDate,
				$endDate,
				$platformVar,
				$channel
			);
				
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: Photo Top 10 articles data

    // B: Get push notification Top 10 articles
    public function getTopPushArticles(String $startDate, String $endDate, String $devices, String $channels)
    {
        if ($devices == 'all') {
            $devs = ['allweb','android', 'ios'];
            if ($channels == 'all') {
                $maxrow = DailyTopPushArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopPushArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->whereIn('devices', $devs)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        } else {
            if ($channels == 'all') {
                $maxrow = DailyTopPushArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '!=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            } else {
                $maxrow = DailyTopPushArticles::select('date','pageviews','visitors','devices','channels','pagetitle')
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)
                    ->where('channels', '=', $channels)
                    ->where('devices', $devices)
                    ->orderBy('visitors', 'DESC')
                    ->take(10)
                    ->get();
            }
        }
		
        $dataToparticle = [];
        foreach ($maxrow as $data) {
            array_push($dataToparticle, [
                'date' => Carbon::parse($data->date)->format('d-m-Y'),
                'pageviews' => $data->pageviews,
                'visitors' => $data->visitors,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'pagetitle' => $data->pagetitle
            ]);

        }
		
        return $dataToparticle;
    }
    // E: Get push notification Top 10 articles

    // B: Push notification Top 10 articles data
    public function topPushArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platformVar = $request->input('platform');
            $channel = $request->input('channels');
			
			$datachannel = [];
			$datachannel = $this->getTopPushArticles(
				$startDate,
				$endDate,
				$platformVar,
				$channel
			);
				
			return $datachannel;
        } else {
            echo "Bad request!";
        }
    }
	// E: Push notification Top 10 articles data
	
}
