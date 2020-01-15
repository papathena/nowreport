<?php

namespace Modules\Ga\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

// Self added
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//use Modules\Traffics\Http\Controllers\TrafficsController;
use DB;

class GaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $twoDays = Carbon::today()->subdays(2)->format('d F Y');
        $oneDays = Carbon::today()->subdays(1)->format('d F Y');

        $data = [
            'platform' => 'all',
            'start' => Carbon::today()->subdays(3)->format('Y-m-d'),
            'end' => Carbon::today()->format('Y-m-d'),
            'channels' => ['all']
        ];

        $trafficData = $this->trafficData($data);
        
        return view('ga::index', [
            'twoDays' => $twoDays,
            'oneDays' => $oneDays,
            'trafficData' => $trafficData
        ]);
    }

    public function trafficData(Array $data)
    {
        $startDate = $data['start'];
        $endDate = $data['end'];
        $platformVar = $data['platform'];
        $channelVar = $data['channels'];

        $dataAll = $this->getTraffics(
            $startDate,
            $endDate,
            $platformVar,
            $channelVar[0]
        );

        return $dataAll; 
    }

    public static function getTraffics(String $startDate, String $endDate, String $devices, String $channels)
    {
        $devs = ['allweb','android','ios'];
        $traffics = DB::table('ga_traffics')
            ->select(DB::raw('date,sum(visitors) as visitors,sum(pageviews) as pageviews,channels'))
            ->whereIn('devices', $devs)
            ->where('channels', $channels)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dataTraffic = [];
        $cnt = 1;
        $diffVisitors = '-';
        $diffPageviews = '-';
        $semVisitors = 0;
        $semPageviews = 0;
        foreach ($traffics as $data) {
            if ($cnt > 1) {
                if ($SemVisitors == 0)
                    $diffVisitors = ($data->visitors - $SemVisitors) * 100;
                else
                    $diffVisitors = round((($data->visitors - $SemVisitors)/$data->visitors), 2) * 100;
                if ($semPageviews == 0)
                    $diffPageviews = ($data->pageviews - $semPageviews) * 100;
                else
                    $diffPageviews = round((($data->pageviews - $semPageviews)/$data->pageviews), 2) * 100;
            }
            else {
                $diffVisitors = '-';
                $diffPageviews = '-';
            }
			if ($diffVisitors == -0) $diffVisitors = 0;
			if ($diffPageviews == -0) $diffPageviews = 0;

            array_push($dataTraffic, [
                'date' => $data->date,
                'visitors' => $data->visitors,
                'pageviews' => $data->pageviews,
                'diffVisitors' => $diffVisitors,
                'diffPageviews' => $diffPageviews
            ]);

            $SemVisitors = $data->visitors;
            $semPageviews = $data->pageviews;
            $cnt++;
        }
        return $dataTraffic;
    }

}
