<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\DailyTopCSArticles;

class DailyTopCSArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function dailyTopCSArticles(Request $request)
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
				'chgroups[]' => 'Direct'
            ];
            $request->merge($params);
            $redirectUrl = $url.'?'.http_build_query($request->query());
            return redirect($redirectUrl);
        } else {
			$channels = config('top10articles.channels');
			
			$chgroups = [];
			foreach (config('channelsource.chGroup') as $chgroup => $datas) {
				$chgroups[] = $datas['title'];
			}
			
			$chgroupFilter = array_diff($chgroups, ['Paid Search']);
			
            $csTopArticles = $this->topCSArticlesData($request);
			
            return view('toparticles::dailytopcsarticles', [
                'channels' => $channels,
				'chgroups' => $chgroupFilter,
                'csTopArticles' => $csTopArticles,
            ]);
        }
    }
	
	public function getTopCSArticles(String $startDate, String $endDate, String $devices, String $channels, Array $chgroup)
    {
		if ($channels == 'all') {
			$maxrow = DailyTopCSArticles::select('date','pageviews','visitors','devices','channels','chgroup','pagetitle')
				->where('devices', $devices)
				->where('channels', '!=', $channels)
				->whereIn('chgroup', $chgroup)
				->where('date', '>=', $startDate)
				->where('date', '<=', $endDate)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		} else {
			$maxrow = DailyTopCSArticles::select('date','pageviews','visitors','devices','channels','chgroup','pagetitle')
				->where('devices', $devices)
				->where('channels', '=', $channels)
				->whereIn('chgroup', $chgroup)
				->where('date', '>=', $startDate)
				->where('date', '<=', $endDate)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		}
		
        $dataToparticle = [];
        
        foreach ($maxrow as $data) {
            array_push($dataToparticle, [
                'date' => Carbon::parse($data->date)->format('d-m-Y'),
                'pageviews' => $data->pageviews,
                'visitors' => $data->visitors,
                'devices' => $data->devices,
                'channels' => $data->channels,
                'chgroup' => $data->chgroup,
                'pagetitle' => $data->pagetitle
            ]);

        }
        return $dataToparticle;
    }
	
	// B: Channel Source Top 10 articles data
    public function topCSArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platform = $request->input('platform');
            $channel = $request->input('channels');
			$chgroup = $request->input('chgroups');
			
			$datachgroup = [];
                $datachgroup = $this->getTopCSArticles(
                    $startDate,
                    $endDate,
                    $platform,
					$channel,
                    $chgroup
                );
				
			return $datachgroup;
        } else {
            echo "Bad request!";
        }
    }
	// E: Channel Source Top 10 articles data
}
