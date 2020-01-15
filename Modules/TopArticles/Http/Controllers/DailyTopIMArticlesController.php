<?php

namespace Modules\TopArticles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Carbon\Carbon;
use Modules\TopArticles\Entities\DailyTopIMArticles;

class DailyTopIMArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dailyTopIMArticles(Request $request)
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
                //$socnet[] = $values['title'];
                $inmarket[] = $key;
            }

            $imTopArticles = $this->topIMArticlesData($request);
            
            return view('toparticles::dailytopimarticles', [
                'channels' => $channels,
                'inmarketName' => $inmarket,
                'imTopArticles' => $imTopArticles,
            ]);
        }
    }
    
    /* B: Get IM Name from Config */
    protected function getInmarket(String $inmarketGA)
    {
        $inmarket = config('inboundmarketing.IM_name');
        foreach($inmarket as $key => $value) {
            if (strpos($inmarketGA, $key) !== false)
                return $key;
        }
        return '';
    }
    /* E: Get IM Name from Config */
    
    public function getTopIMarticles(String $startDate, String $endDate, String $devices, String $channels, Array $inmarket)
    {
        if (($channels == 'all')) {
            $maxrow = DailyTopIMArticles::select('date','pageviews','visitors','devices','channels','inmarket','pagetitle')
                ->distinct()
                ->where('devices', $devices)
                ->where('channels', '!=', $channels)
                ->whereIn('inmarket', $inmarket)
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->orderBy('visitors', 'DESC')
                ->take(10)
                ->get();
        } else {
            $maxrow = DailyTopIMArticles::select('date','pageviews','visitors','devices','channels','inmarket','pagetitle')
                ->distinct()
                ->where('devices', $devices)
                ->where('channels', $channels)
                ->whereIn('inmarket', $inmarket)
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
                'inmarket' => $this->getInmarket($data->inmarket),
                'pagetitle' => $data->pagetitle
            ]);

        }
        return $dataToparticle;
    }

    // B: Inbound Marketing Top 10 articles data
    public function topIMArticlesData(Request $request)
    {
        if ($request->isMethod('get')) {
            $startDate = $request->input('start');
            $endDate = $request->input('end');
            $platform = $request->input('platform');
            $channel = $request->input('channels');
            $inmarket = $request->input('inmarket');
            
            $datainmarket = [];
            $datainmarket = $this->getTopIMArticles(
                $startDate,
                $endDate,
                $platform,
                $channel,
                $inmarket
            );
                
            return $datainmarket;
        } else {
            echo "Bad request!";
        }
    }
    // E: Inbound Marketing Top 10 articles data
}
