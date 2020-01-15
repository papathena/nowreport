<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\DailyTopIMArticles;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Date;
use Modules\TopArticles\Helpers\TopIMArticlesHelper;

class DailyTopIMArticlesController extends Controller
{
    /* B: Split year & month */
    private function splitYearMonth(String $yearMonth) {
        return [
            'year' => substr($yearMonth, 0, 4),
            'month' => substr($yearMonth,-2, 2)
        ]; 
    }
    /* E: Split year & month */

    /* B: filter inbound marketing */
    private function inMarket(String $inmarket) {
        return in_array($inmarket, config('inboundmarketing.IM_name'));
    }
    /* E: filter inbound marketing */

    /* B: Store Daily IM Article */
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
        String $inmarket,
        String $title)
    {
        $gaIMArticles = new DailyTopIMArticles();
        $gaIMArticles->date = $date;
        $gaIMArticles->dayDate = $dayDate;
        $gaIMArticles->dayName = $dayName;
        $gaIMArticles->weekYear = $weekYear;
        $gaIMArticles->monthYear = $monthYear;
        $gaIMArticles->year = $year;
        $gaIMArticles->devices = $devices;
        $gaIMArticles->channels = $channels;
        $gaIMArticles->visitors = $visitors;
        $gaIMArticles->pageviews = $pageviews;
        $gaIMArticles->inmarket = $inmarket;
        $gaIMArticles->pagetitle = $title;
        $gaIMArticles->save();
    }
    /* E: Store Daily IM Article */

    /* B: Update Daily IM Articles */
    protected function dailyUpdate(
        String $date, 
        String $devices, 
        String $channels, 
        int $visitors,
        int $pageviews,
        String $inmarket,
        String $title)
    {
        $gaIMArticles = DailyTopIMArticles::where([
            'date' => $date,
            'devices' => $devices,
            'channels' => $channels,
            'inmarket' => $inmarket,
            'pageTitle' => $title, 
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* E: Update Daily IM Articles */

    /* B: Daily Check Has Data Top Articles*/
    protected function dailyHasData(String $dates, String $devices, String $channels, String $inmarket, String $title)
    {
        $datas = DailyTopIMArticles::where([
            'date' => $dates, 
            'devices' => $devices, 
            'channels' => $channels,
            'inmarket' => $inmarket,
            'pagetitle' => $title,
        ])->first();
        if (is_null($datas))
            return false;
        else 
            return true;
    }
    /* E: Daily Check Has Data Top Articles*/

    /* B: Daily Check Less IM Top Articles*/ 
    protected function dailyLessData(
        String $dates, 
        String $devices, 
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $inmarket,
        String $title)
    {
        $datas = DailyTopIMArticles::where([
            'date' => $dates, 
            'devices' => $devices, 
            'channels' => $channels,
            'inmarket' => $inmarket,
            'pagetitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews)) 
            return true;
        else
            return false;
    }
    /* E: Daily Check Less IM Top Articles*/

    /* B: Get Daily IM Top Artticles */
    public function dailyGetData(Period $period, String $platform, String $devices, String $inmarket, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopIMArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopIMArticles($period, $devices, $inmarket, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopIMArticles($period, $devices, $inmarket, $channels, $filters);
                break;
            default : $data = $getQuery->webTopIMArticles($period, $devices, $inmarket, $channels, $filters);
        }
        return $data;
    }
    /* E: Get Daily IM Top Articles */

    /* B: Push Daily IM Articles*/
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
            $data['inmarket'],
            $data['pageTitle']
        );
    }
    /* E: Push Daily IM Articles */

    /* B: Update Daily IM Articles */
    public function dailyUpdateData($data)
    {
        $this->dailyUpdate(
            $data['date'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['inmarket'],
            $data['pageTitle']
        );
    }
    /* E: Update Daily IM Articles */

    /* B: Pull Top IM Articles */
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
            $inmarketName = config('inboundmarketing.IM_name');
            $lenDays = $endDate->diffInDays($startDate);
            for ($a=0; $a<=$lenDays; $a++) {
                echo '>>>> TGL '.$startDate.' <<<<'."\n";
                $period = new Period($startDate, $startDate);
                //if ($platform == 'web') {
                $filters = config('inboundmarketing.IM_filter.'.$channel);
                foreach ($websites as $dev => $devices) {
                    foreach ($inmarketName as $names => $datas) {
                        $comFilter = ';'.$datas['filter'];
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
                            if (!$this->dailyHasData($dataArticle['date'],$dev,$channel,$dataArticle['inmarket'],$dataArticle['pageTitle'])) {
                                echo 'Push data '. $dataArticle['date'].' '.$dev.' '.$channel.' '.$dataArticle['inmarket'].' '.$dataArticle['pageTitle'].' '.$dataArticle['visitors']."\n";
                                $this->dailyPushData($dataArticle);
                            } elseif ($this->dailyLessData($dataArticle['date'],$dev,$channel, $dataArticle['visitors'],$dataArticle['pageviews'],$dataArticle['inmarket'],$dataArticle['pageTitle'])) {
                                echo 'Update data '.$dataArticle['date'].' '.$dev.' '.$channel." ".$dataArticle['inmarket'].' '.$dataArticle['pageTitle'].' '.$dataArticle['visitors']."\n";
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
