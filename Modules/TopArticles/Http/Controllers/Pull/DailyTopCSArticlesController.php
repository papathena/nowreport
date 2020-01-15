<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\DailyTopCSArticles;
use Modules\TopArticles\Helpers\TopCSArticlesHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Date;

class DailyTopCSArticlesController extends Controller
{
    /* Start of split year & month */
    private function splitYearMonth(String $yearMonth) {
        return [
            'year' => substr($yearMonth, 0, 4),
            'month' => substr($yearMonth,-2, 2)
        ]; 
    }
    /* End of split year & month */

    /* Start of filter channel group */
    private function inChGroup(String $chgroup) {
        return in_array($chgroup, config('channelgroup.chGroup'));
    }
    /* End of filter channel group */

    /* Start of Store Daily CS Article */
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
        String $chgroup,
        String $title)
    {
        $gacsarticles = new DailyTopCSArticles();
        $gacsarticles->date = $date;
        $gacsarticles->dayDate = $dayDate;
        $gacsarticles->dayName = $dayName;
        $gacsarticles->weekYear = $weekYear;
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
    /* End of Store Daily CS Article */

    /* Start of Update Daily CS Articles */
    protected function dailyUpdate(
        String $date, 
        String $devices, 
        String $channels, 
        int $visitors,
        int $pageviews,
        String $chgroup,
        String $title)
    {
        $gacsarticles = DailyTopCSArticles::where([
            'date' => $date,
            'devices' => $devices,
            'channels' => $channels,
            'chgroup' => $chgroup,
            'pageTitle' => $title, 
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* End of Update Daily CS Articles */

    /* Start of Daily Check Has Data Top Articles*/
    protected function dailyHasData(String $dates, String $devices, String $channels, String $chgroup, String $title)
    {
        $datas = DailyTopCSArticles::where([
            'date' => $dates, 
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
    /* End of Daily Check Has Data Top Articles*/

    /* Start of Daily Check Less CS Top Articles*/ 
    protected function dailyLessData(
        String $dates, 
        String $devices, 
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $chgroup,
        String $title)
    {
        $datas = DailyTopCSArticles::where([
            'date' => $dates, 
            'devices' => $devices, 
            'channels' => $channels,
            'chgroup' => $chgroup,
            'pagetitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews)) 
            return true;
        else
            return false;
    }
    /* End of Daily Check Less CS Top Articles*/

    /* Start of Get Daily CS Top Artticles */
    public function dailyGetData(Period $period, String $platform, String $devices, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopCSArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopCSArticles($period, $devices, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopCSArticles($period, $devices, $channels, $filters);
                break;
            default : $data = $getQuery->webTopCSArticles($period, $devices, $channels, $filters);
        }
        return $data;
    }
    /* End of Get Daily CS Top Articles */

    /* Start of Push Daily CS Articles*/
    public function dailyPushData($data)
    {
        $yearMonth = $this->splitYearMonth($data['monthYear']);
        $this->dailyStore(
            $data['date'],
            $data['dayDate'],
            $data['dayName'],
            $data['weekYear'],
            //$data['monthYear'],
            //$data['year'],
            $yearMonth['month'],
            $yearMonth['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['chgroup'],
            $data['pageTitle']
        );
    }
    /* End of Push Daily CS Articles */

    /* Start of Update Daily CS Articles */
    public function dailyUpdateData($data)
    {
        $this->dailyUpdate(
            $data['date'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['chgroup'],
            $data['pageTitle']
        );
    }
    /* End of Update Daily CS Articles */

    /* Pull Top CS Articles */
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
            $channelName = config('channelsource.chGroup');
            $lenDays = $endDate->diffInDays($startDate);
            for ($a=0; $a<=$lenDays; $a++) {
                echo '>>>> TGL '.$startDate.' <<<<'."\n";
                $period = new Period($startDate, $startDate);
                //if ($platform == 'web') {
                $filters = config('channelsource.chGroup_filter.'.$channel);
                foreach ($websites as $dev => $devices) {
                    foreach ($channelName as $names => $datas) {
                        $comFilter = ';ga:channelGrouping=~'.$datas['filter'];
                        $webCSArticle = $this->dailyGetData(
                            $period,
                            $platform,
                            $dev,
                            $channel,
                            $filters[$devices].$comFilter
                        );

                        echo $filters[$devices].$comFilter . "\n";
                        foreach ($webCSArticle as $dataArticle) {
                            if (!$this->dailyHasData($dataArticle['date'],$dev,$channel,$dataArticle['chgroup'],$dataArticle['pageTitle'])) {
                                echo 'Push data '. $dataArticle['date'].' '.$dev.' '.$channel.' '.$dataArticle['chgroup'].' '.$dataArticle['pageTitle'].' '.$dataArticle['visitors']."\n";
                                $this->dailyPushData($dataArticle);
                            } elseif ($this->dailyLessData($dataArticle['date'],$dev,$channel, $dataArticle['visitors'],$dataArticle['pageviews'],$dataArticle['chgroup'],$dataArticle['pageTitle'])) {
                                echo 'Update data '.$dataArticle['date'].' '.$dev.' '.$channel." ".$dataArticle['chgroup'].' '.$dataArticle['pageTitle'].' '.$dataArticle['visitors']."\n";
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

}
