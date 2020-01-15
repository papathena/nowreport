<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\MonthlyTopCSArticles;
use Modules\TopArticles\Helpers\TopCSArticlesHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Date;

class MonthlyTopCSArticlesController extends Controller
{
    /* Start of Store Monthly CS Article */
    protected function monthlyStore(
        String $monthYear,
        String $year, 
        string $devices, 
        String $channels, 
        int $visitors,
        int $pageviews,
        String $chgroup,
        String $title)
    {
        $gacsarticles = new MonthlyTopCSArticles();
        $gacsarticles->monthYear = $monthYear;
        $gacsarticles->year = $year;
        $gacsarticles->devices = $devices;
        $gacsarticles->channels = $channels;
        $gacsarticles->visitors = $visitors;
        $gacsarticles->pageviews = $pageviews;
        $gacsarticles->chgroup = $chgroup;
        $gacsarticles->pagetitle = $title;
        $gacsarticles->save();
    }
    /* End of Store Monthly CS Article */

    /* Start of Update Monthly CS Articles */
    protected function monthlyUpdate(
        String $month,
        String $year,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $chgroup,
        String $title)
    {
        $gacsarticles = MonthlyTopCSArticles::where([
            'monthYear' => $month,
            'year' => $year,
            'devices' => $devices,
            'channels' => $channels,
            'chgroup' => $chgroup,
            'pageTitle' => $title,
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* End of Update Monthly CS Articles */

    /*Start of Monthly Check Has Data Top Articles*/
    protected function monthlyHasData(String $month, String $devices, String $channels, String $chgroup, String $title)
    {
        $datas = MonthlyTopCSArticles::where([
            'monthYear' => $month, 
            'devices' => $devices, 
            'channels' => $channels,
            'chgroup' => $chgroup,
            'pagetitle' => $title,
        ])->first();
        if (is_null($datas))
            return false;
        else 
            return true;
    }
    /* End of Monthly Check Has Data Top Articles*/

    /* Start of Monthly Check Less CS Top Articles*/
    protected function monthlyLessData(
        String $month,
        String $year, 
        String $devices, 
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $chgroup,
        String $title)
    {
        $datas = MonthlyTopCSArticles::where([
            'monthYear' => $month,
            'year' => $year, 
            'devices' => $devices, 
            'channels' => $channels,
            'chgroup' => $chgroup,
            'pageTitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews))
            return true;
        else
            return false;
    }
    /* End of Monthly Check Less CS Top Articles*/

    /* Start of Get Monthly CS Top Articles */
    public function monthlyGetData(Period $period, String $platform, String $devices, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopCSArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopCSArticlesMonthly($period, $devices, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopCSArticlesMonthly($period, $devices, $channels, $filters);
                break;
            default : $data = $getQuery->webTopCSArticlesMonthly($period, $devices, $channels, $filters);
        }
        return $data;
    }
    /* End of Get Monthly CS Top Articles*/

    /* Start of Push Monthly CS Top Articles */
    public function monthlyPushData($data)
    {
        $this->monthlyStore(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['chgroup'],
            $data['pageTitle']
        );
    }
    /* End of Push Monthly CS Top Articles */

    /* Start of Update Monthly CS Top Articles */
    public function monthlyUpdateData($data)
    {
        $this->monthlyUpdate(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['chgroup'],
            $data['pageTitle']
        );
    }
    /* End of Update Monthly CS Top Articles */

    /* Start of Pull Monthly Data from Google */
    public function monthlyPull(Request $request)
    {
        if ($request->isMethod('get')) {
            $platform = $request->input('platform');
            $channel = $request->input('channel');
            if (is_null($request->input('start')) || is_null($request->input('end'))) {
                $startDate = Carbon::now()->subMonths(2);
                $endDate = Carbon::now();
            } else {
                $startDate = Carbon::parse($request->input('start'));
                $endDate = Carbon::parse($request->input('end'));
            }

            $startMonth = $startDate->format('m');
            $endMonth = $endDate->format('m');
            $websites = config('top10articles.web');
            $channelName = config('channelsource.chGroup');
            $lenMonths = $endDate->diffInmonths($startDate);

            for ($a=0; $a<=$lenMonths; $a++) {
                echo '>>>> Month '.$startDate->format('F').' <<<<'."\n";
                if ($startDate->format('m') != $endMonth) {
                    $start = $startDate->toDateString();
                    $end = strtotime("+1 month", strtotime($start));
                    $end = date("Y-m-d", strtotime("-1 day", $end));
                } else {
                    $start = $startDate->toDateString();
                    $end = date("Y-m-d", strtotime($endDate->toDateString()));
                }
                echo 'Period '.$a.' : '.$start.' to '.$end."\n";
                $period = new Period(Carbon::parse($start), Carbon::parse($end));
                if ($platform == 'web') {
                    $filters = config('channelsource.chGroup_filter.'.$channel);
                    foreach ($websites as $dev => $devices) {
                        foreach ($channelName as $names => $datas) {
                            $comFilter = ';ga:channelGrouping=~'.$datas['filter'];
                            $webCSArticle = $this->monthlyGetData(
                                $period,
                                $platform,
                                $dev,
                                $channel,
                                $filters[$devices].$comFilter
                            );

                            echo $filters[$devices].$comFilter . "\n";
                            foreach ($webCSArticle as $dataArticle) {
                                if (!$this->monthlyHasData($dataArticle['month'],$dev,$channel,$dataArticle['chgroup'],$dataArticle['pageTitle'])) {
                                    echo 'Push data '. $dataArticle['month'].' '.$dev.' '.$channel.' '.$dataArticle['chgroup'].' '. $dataArticle['pageTitle']."\n";
                                    $this->monthlyPushData($dataArticle);
                                } elseif ($this->monthlyLessData($dataArticle['month'],$dataArticle['year'],$dataArticle['devices'],$dataArticle['channels'],$dataArticle['visitors'], $dataArticle['pageviews'], $dataArticle['chgroup'], $dataArticle['pageTitle'])) {
                                    echo 'Update data '.$dataArticle['month'].' '.$dev.' '.$channel." ".$dataArticle['chgroup'].' '.$dataArticle['pageTitle']."\n";
                                    $this->monthlyUpdateData($dataArticle);
                                } else {
                                    echo 'Data '.$dataArticle['month'].' '.$dev.' '.$channel." ".$dataArticle['pageTitle'].' OK'."\n";
                                }
                            }
                        }
                    }
                }
                $startDate->addMonth();
            }
        } else {
            echo "Bad Request!!!";
        }
    }
    /* End of Pull Monthly Data from Google */

}
