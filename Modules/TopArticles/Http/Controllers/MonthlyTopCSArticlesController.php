<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\MonthlyTopCSArticles;
use App\Helpers\MonthName;

class MonthlyTopCSArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function monthlyTopCSArticles(Request $request)
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
			
            return view('toparticles::monthlytopcsarticles', [
                'channels' => $channels,
				'chgroups' => $chgroupFilter,
                'csTopArticles' => $csTopArticles,
            ]);
        }
    }
	
	public function getTopCSarticles(String $startMonth, String $endMonth,  String $startYear, String $endYear, String $devices, String $channels, Array $chgroup)
    {
		if ($channels == 'all') {
			$toparticles = MonthlyTopCSArticles::select('monthYear','year','pageviews','visitors','devices','channels','chgroup','pagetitle')
				->where('devices', $devices)
				->where('channels', '!=', $channels)
				->whereIn('chgroup', $chgroup)
				->where('monthYear', '>=', $startMonth)
				->where('monthYear', '<=', $endMonth)
				->where('year', '>=', $startYear)
				->where('year', '<=', $endYear)
				->orderBy('visitors', 'DESC')
				->take(10)
				->get();
		} else {
			$toparticles = MonthlyTopCSArticles::select('monthYear','year','pageviews','visitors','devices','channels','chgroup','pagetitle')
				->where('devices', $devices)
				->where('channels', $channels)
				->whereIn('chgroup', $chgroup)
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
				'chgroup' => $data->chgroup,
                'pagetitle' => $data->pagetitle,
            ]);

        }
        return $dataToparticle;
	}
	
	public function topCSArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startMonth = Carbon::parse($request->input('start'))->format('m');
            $endMonth = Carbon::parse($request->input('end'))->format('m');
            $startYear = Carbon::parse($request->input('start'))->format('Y');
            $endYear = Carbon::parse($request->input('end'))->format('Y');
			
            $platform = $request->input('platform');
            $channel = $request->input('channels');
			//$chgroupVar = $request->input('chgroups');
			$chgroup = $request->input('chgroups');
			
            //$arrayCS = [];
            //$tabsData = [];
            //$tabs = 1;
            //foreach($chgroupVar as $chgroup) {
                //$datachgroup = $chgroup.'Data';
				$datachgroup = [];
                $datachgroup = $this->getTopCSArticles(
                    $startMonth,
                    $endMonth,
                    $startYear,
                    $endYear,
                    $platform,
                    $channel,
					$chgroup
                );
				
                //$arrayCS[$datachgroup] = ${$datachgroup};
                //$tabsData['tabs-'.$tabs] =  [ucwords($chgroup), $chgroup.'Data'];
                //$tabs++;
            //}
			/*return [
				'arrayCS' => $arrayCS,
				'tabsData' => $tabsData,
				'actvChannel' => $channel,
			];*/
			return $datachgroup;
        } else {
            echo "Bad request!";
        }
	}
	
}
