<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\DailyTopSNArticles;

class DailyTopSNArticlesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function dailyTopSNArticles(Request $request)
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
                'channels' => 'all',
				'socnet[]' => 'facebook'
            ];
            $request->merge($params);
            $redirectUrl = $url.'?'.http_build_query($request->query());
            return redirect($redirectUrl);
        } else {
			$excludeChannels = ['wp' => 'Welcome page', '20' => '20Detik', 'forum' => 'Forum'];
			$channels = array_diff(config('top10articles.channels'), $excludeChannels);

			$socnet = [];
			foreach (config('socialnetwork.socnet_name') as $key => $values) {
				//$socnet[] = $values['title'];
				$socnet[] = $key;
			}

            $snTopArticles = $this->topSNArticlesData($request);
			
            return view('toparticles::dailytopsnarticles', [
                'channels' => $channels,
				'socnetName' => $socnet,
                'snTopArticles' => $snTopArticles,
            ]);
        }
    }
	
	/* B: Get Socnet Name from Config */
	protected function getSocnet(String $socnetGA)
    {
        $socnet = config('socialnetwork.socnet_name');
        foreach($socnet as $key => $value) {
            if (strpos($socnetGA, $key) !== false)
                return $key;
        }
        return '';
    }
	/* E: Get Socnet Name from Config */
	
    public function getTopSNarticles(String $startDate, String $endDate, String $devices, String $channels, Array $socnet)
    {
		//$implSocnet = implode('|', $socnet);
		if (($channels == 'all')) {
			$maxrow = DailyTopSNArticles::select('date','pageviews','visitors','devices','channels','socnet','pagetitle')
                ->distinct()
				->where('devices', $devices)
				->where('channels', '!=', $channels)
				->whereIn('socnet', $socnet)
				->where('date', '>=', $startDate)
				->where('date', '<=', $endDate)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		} else {
			$maxrow = DailyTopSNArticles::select('date','pageviews','visitors','devices','channels','socnet','pagetitle')
                ->distinct()
				->where('devices', $devices)
				->where('channels', $channels)
				->whereIn('socnet', $socnet)
				->where('date', '>=', $startDate)
				->where('date', '<=', $endDate)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		}

        $dataToparticle = [];
        //$cnt = 1;
        foreach ($maxrow as $data) {
            array_push($dataToparticle, [
                'date' => $data->date,
                'pageviews' => $data->pageviews,
                'visitors' => $data->visitors,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'socnet' => $this->getSocnet($data->socnet),
                'pagetitle' => $data->pagetitle
            ]);

        }
        return $dataToparticle;
    }

	// B: Social Network Top 10 articles data
    public function topSNArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platform = $request->input('platform');
            $channel = $request->input('channels');
			$socnet = $request->input('socnet');
			
			$datasocnet = [];
			$datasocnet = $this->getTopSNArticles(
				$startDate,
				$endDate,
				$platform,
				$channel,
				$socnet
			);
				
			return $datasocnet;
        } else {
            echo "Bad request!";
        }
    }
	// E: Social Network Top 10 articles data
}
