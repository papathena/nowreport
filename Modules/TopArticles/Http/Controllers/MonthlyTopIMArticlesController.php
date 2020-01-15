<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\MonthlyTopIMArticles;
use App\Helpers\MonthName;

class MonthlyTopIMArticlesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function monthlyTopIMArticles(Request $request)
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
				'inmarket[]' => 'adwords'
            ];
            $request->merge($params);
            $redirectUrl = $url.'?'.http_build_query($request->query());
            return redirect($redirectUrl);
        } else {
			$excludeChannels = ['wp' => 'Welcome page', '20' => '20Detik', 'forum' => 'Forum'];
			$channels = array_diff(config('top10articles.channels'), $excludeChannels);
			$inmarket = [];
			foreach (config('inboundmarketing.IM_name') as $key => $values) {
				$inmarket[] = $key;
			}

			$imTopArticles = $this->topIMArticlesData($request);
			return view('toparticles::monthlytopimarticles', [
				'channels' => $channels ,
				'inmarketName' => $inmarket,
				'imTopArticles' => $imTopArticles
			]);
		}
    }

	public function getTopIMarticles(String $startMonth, String $endMonth, String $startYear, String $endYear, String $devices, String $channels, Array $inmarket)
    {
		if ($channels == 'all') {
			$toparticles = MonthlyTopIMArticles::select('monthYear','year','pageviews','visitors','devices','channels','inmarket','pagetitle')
				->distinct()
				->where('devices', $devices)
				->where('channels', '!=', $channels)
				->whereIn('inmarket', $inmarket)
				->where('monthYear', '>=', $startMonth)
				->where('monthYear', '<=', $endMonth)
				->where('year', '>=', $startYear)
				->where('year', '<=', $endYear)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		} else {
			$toparticles = MonthlyTopIMArticles::select('monthYear','year','pageviews','visitors','devices','channels','inmarket','pagetitle')
				->distinct()
				->where('devices', $devices)
				->where('channels', $channels)
				->whereIn('inmarket', $inmarket)
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
				'inmarket' => $data->inmarket,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
	}

		public function topIMArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platform = $request->input('platform');
            $channel = $request->input('channels');
			$inmarket = $request->input('inmarket');
			
			$datainmarket = [];
			$datainmarket = $this->getTopIMArticles(
				$startMonth,
				$endMonth,
				$startYear,
				$endYear,
				$platform,
				$channel,
				$inmarket
			);
				
			return $datainmarket;
        } else {
            echo "Bad request!";
        }
	}
}
