<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\DailyTopSNArticles;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Date;
use Modules\TopArticles\Helpers\TopSNArticlesHelper;

class DailyTopSNArticlesController extends Controller
{
    /* B: Split year & month */
    private function splitYearMonth(String $yearMonth) {
        return [
            'year' => substr($yearMonth, 0, 4),
            'month' => substr($yearMonth,-2, 2)
        ]; 
    }
    /* E: Split year & month */

    /* B: filter social network */
    private function inSocnet(String $socnet) {
        return in_array($socnet, config('socialnetwork.socnet_name'));
    }
    /* E: filter socialnetwork */

    /* B: Store Daily SN Article */
    protected function dailyStore(
        String $date, 
        String $dayDate,
        String $dayName, 
        String $weekYear,
        String $monthYear,
        String $year, 
        string $devices, 
        String $channels, 
        int $visitors,
        int $pageviews,
        String $socnet,
        String $title)
    {
        $gaSNArticles = new DailyTopSNArticles();
        $gaSNArticles->date = $date;
        $gaSNArticles->dayDate = $dayDate;
        $gaSNArticles->dayName = $dayName;
        $gaSNArticles->weekYear = $weekYear;
        $gaSNArticles->monthYear = $monthYear;
        $gaSNArticles->year = $year;
        $gaSNArticles->devices = $devices;
        $gaSNArticles->channels = $channels;
        $gaSNArticles->visitors = $visitors;
        $gaSNArticles->pageviews = $pageviews;
        $gaSNArticles->socnet = $socnet;
        $gaSNArticles->pagetitle = $title;
        $gaSNArticles->save();
    }
    /* E: Store Daily SN Article */

    /* B: Update Daily SN Articles */
    protected function dailyUpdate(
        String $date, 
        String $devices, 
        String $channels, 
        int $visitors,
        int $pageviews,
        String $socnet,
        String $title)
    {
        $gaSNArticles = DailyTopSNArticles::where([
            'date' => $date,
            'devices' => $devices,
            'channels' => $channels,
            'socnet' => $socnet,
            'pageTitle' => $title, 
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* E: Update Daily SN Articles */

    /* B: Daily Check Has Data Top Articles*/
    protected function dailyHasData(String $dates, String $devices, String $channels, String $socnet, String $title)
    {
        $datas = DailyTopSNArticles::where([
            'date' => $dates, 
            'devices' => $devices, 
            'channels' => $channels,
            'socnet' => $socnet,
            'pagetitle' => $title,
        ])->first();
        if (is_null($datas))
            return false;
        else 
            return true;
    }
    /* E: Daily Check Has Data Top Articles*/

    /* B: Daily Check Less SN Top Articles*/ 
    protected function dailyLessData(
        String $dates, 
        String $devices, 
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $socnet,
        String $title)
    {
        $datas = DailyTopSNArticles::where([
            'date' => $dates, 
            'devices' => $devices, 
            'channels' => $channels,
            'socnet' => $socnet,
            'pagetitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews)) 
            return true;
        else
            return false;
    }
    /* E: Daily Check Less SN Top Articles*/

    /* B: Get Daily SN Top Artticles */
    public function dailyGetData(Period $period, String $platform, String $devices, String $socnet, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopSNArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopSNArticles($period, $devices, $socnet, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopSNArticles($period, $devices, $socnet, $channels, $filters);
                break;
            default : $data = $getQuery->webTopSNArticles($period, $devices, $socnet, $channels, $filters);
        }
        return $data;
    }
    /* E: Get Daily SN Top Articles */

    /* B: Push Daily SN Articles*/
    public function dailyPushData($data)
    {
        $yearMonth = $this->splitYearMonth($data['yearMonth']);
        $this->dailyStore(
            $data['date'],
            $data['dayDate'],
            $data['dayName'],
            $data['weekYear'],
            $yearMonth['month'],
            $yearMonth['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['socnet'],
            $data['pageTitle']
        );
    }
    /* E: Push Daily SN Articles */

    /* B: Update Daily SN Articles */
    public function dailyUpdateData($data)
    {
        $this->dailyUpdate(
            $data['date'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['socnet'],
            $data['pageTitle']
        );
    }
    /* E: Update Daily SN Articles */

    /* B: Pull Top SN Articles */
    public function dailyPull(Request $request)
    {
        if ($request->isMethod('get')) {
            $platform = $request->input('platform');
            $channel = $request->input('channel');
            if (is_null($request->input('start')) || is_null($request->input('end'))) {
                //$startDate = Carbon::now()->subDays(6);
                $startDate = Carbon::now()->subWeeks(1);
                $endDate = Carbon::now();
            } else {
                $startDate = Carbon::parse($request->input('start'));
                $endDate = Carbon::parse($request->input('end'));
            }
            $websites = config('top10articles.web');
            $socnetName = config('socialnetwork.socnet_name');
            $lenDays = $endDate->diffInDays($startDate);
            for ($a=0; $a<=$lenDays; $a++) {
                echo '>>>> TGL '.$startDate.' <<<<'."\n";
                $period = new Period($startDate, $startDate);
                //if ($platform == 'web') {
                $filters = config('socialnetwork.socnet_filter.'.$channel);
                foreach ($websites as $dev => $devices) {
                    foreach ($socnetName as $names => $datas) {
                        $comFilter = ';ga:sourceMedium=~'.$datas['filter'];
                        $webSNArticle = $this->dailyGetData(
                            $period,
                            $platform,
                            $dev,
                            $names,
                            $channel,
                            $filters[$devices].$comFilter
                        );
                        
                        echo $filters[$devices].$comFilter . "\n";
                        foreach ($webSNArticle as $dataArticle) {
                            if (!$this->dailyHasData($dataArticle['date'],$dev,$channel,$dataArticle['socnet'],$dataArticle['pageTitle'])) {
                                echo 'Push data '. $dataArticle['date'].' '.$dev.' '.$channel.' '.$dataArticle['socnet'].' '.$dataArticle['pageTitle'].' '.$dataArticle['visitors']."\n";
                                $this->dailyPushData($dataArticle);
                            } elseif ($this->dailyLessData($dataArticle['date'],$dev,$channel, $dataArticle['visitors'],$dataArticle['pageviews'],$dataArticle['socnet'],$dataArticle['pageTitle'])) {
                                echo 'Update data '.$dataArticle['date'].' '.$dev.' '.$channel." ".$dataArticle['socnet'].' '.$dataArticle['pageTitle'].' '.$dataArticle['visitors']."\n";
                                $this->dailyUpdateData($dataArticle);
                            } else {
                                echo 'Data '.$dataArticle['date'].' '.$dev.' '.$channel." ".$dataArticle['pageTitle'].' OK'."\n";
                            }
                        }
                    }
                }
                $startDate->addDay();
            }
        } else {
            echo "Bad Request!!!";
        }
    }
    /* E: Pull Daily Top Articles */
}
