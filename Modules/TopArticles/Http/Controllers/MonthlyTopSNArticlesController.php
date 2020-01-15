<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\MonthlyTopSNArticles;
use App\Helpers\MonthName;

class MonthlyTopSNArticlesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function monthlyTopSNArticles(Request $request)
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
			return view('toparticles::monthlytopsnarticles', [
				'channels' => $channels ,
				'socnetName' => $socnet,
				'snTopArticles' => $snTopArticles
			]);
		}
    }

	public function getTopSNarticles(String $startMonth, String $endMonth, String $startYear, String $endYear, String $devices, String $channels, Array $socnet)
    {
		if ($channels == 'all') {
			$toparticles = MonthlyTopSNArticles::select('monthYear','year','pageviews','visitors','devices','channels','socnet','pagetitle')
				->distinct()
				->where('devices', $devices)
				->where('channels', '!=', $channels)
				->whereIn('socnet', $socnet)
				->where('monthYear', '>=', $startMonth)
				->where('monthYear', '<=', $endMonth)
				->where('year', '>=', $startYear)
				->where('year', '<=', $endYear)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		} else {
			$toparticles = MonthlyTopSNArticles::select('monthYear','year','pageviews','visitors','devices','channels','socnet','pagetitle')
				->distinct()
				->where('devices', $devices)
				->where('channels', $channels)
				->whereIn('socnet', $socnet)
				->where('monthYear', '>=', $startMonth)
				->where('monthYear', '<=', $endMonth)
				->where('year', '>=', $startYear)
				->where('year', '<=', $endYear)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
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
				'socnet' => $data->socnet,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
	}

		public function topSNArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platform = $request->input('platform');
            $channel = $request->input('channels');
			$socnet = $request->input('socnet');
			
			$datasocnet = [];
			$datasocnet = $this->getTopSNArticles(
				$startMonth,
				$endMonth,
				$startYear,
				$endYear,
				$platform,
				$channel,
				$socnet
			);
				
			return $datasocnet;
        } else {
            echo "Bad request!";
        }
	}

}
