<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\DailyTopPushArticles;
use Modules\TopArticles\Helpers\TopPushArticlesHelper;
use Carbon\Carbon;
use Spatie\Analytics\Period;

class DailyTopPushArticlesController extends Controller
{
	/* B: Store Daily Data */
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
        String $title)
	{
		$gatoparticles = new DailyTopPushArticles();
		$gatoparticles->date = $date;
		$gatoparticles->dayDate = $dayDate;
		$gatoparticles->dayName = $dayName;
		$gatoparticles->weekYear = $weekYear;
		$gatoparticles->monthYear = $monthYear;
		$gatoparticles->year = $year;
		$gatoparticles->devices = $devices;
		$gatoparticles->channels = $channels;
		$gatoparticles->visitors = $visitors;
		$gatoparticles->pageviews = $pageviews;
		$gatoparticles->pagetitle = $title;
		$gatoparticles->save();
	}
    /* E: Store Daily Data */

    /* B: Update Daily Data */
    protected function dailyUpdate(
        String $date,
        String $devices,
        String $channels,
        int $visitors,
        int $pageviews,
        String $title)
    {
        $gavisitors = DailyTopPushArticles::where([
            'date' => $date,
            'devices' => $devices,
            'channels' => $channels,
            'pageTitle' => $title,
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* E: Update Daily Data */
	
	/* B: Daily Check Has Data Top Articles*/
    protected function dailyHasData(String $dates, String $devices, String $channels, String $title)
    {
        $datas = DailyTopPushArticles::where([
            'date' => $dates,
            'devices' => $devices,
            'channels' => $channels,
            'pagetitle' => $title,
        ])->first();
        if (is_null($datas))
            return false;
        else
            return true;
    }
    /* E: Daily Check Has Data Top Articles*/

    /* B: Daily Check Less Data Top Articles*/
    protected function DailyLessData(
        String $dates,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $title)
    {
        $datas = DailyTopPushArticles::where([
            'date' => $dates,
            'devices' => $devices,
            'channels' => $channels,
            'pagetitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews))
            return true;
        else
            return false;
    }
    /* E: Daily Check Less Data Top Articles*/
	
	/* B: Get Daily Data */
    public function dailyGetData(Period $period, String $platform, String $devices, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopPushArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopPushArticles($period, $devices, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopPushArticles($period, $devices, $channels, $filters);
                break;
            default : $data = $getQuery->webTopPushArticles($period, $devices, $channels, $filters);
        }
        return $data;
    }
    /* E: Get Daily Data */

    /* B: Push Daily Data*/
    public function dailyPushData($data)
    {
        $this->dailyStore(
            $data['date'],
            $data['dayDate'],
            $data['dayName'],
            $data['weekYear'],
            $data['monthYear'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['pageTitle']
        );
    }
    /* E: Push Daily Data */

    /* B: Update Daily Data */
    public function dailyUpdateData($data)
    {
        $this->dailyUpdate(
            $data['date'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['pageTitle']
        );
    }
    /* E: Update Daily Data */
	
	/* B Pull Daily Data from Google */
    /* Pull Push Notification Top Articles*/
    public function dailyPull(Request $request)
    {
        if ($request->isMethod('get')) {
            $platform = $request->input('platform');
            $channel = $request->input('channel');
            if (is_null($request->input('start')) || is_null($request->input('end'))) {
                $startDate = Carbon::parse(Carbon::now()->subWeeks(1)->format('Y-m-d'));
                $endDate = Carbon::parse(Carbon::now()->format('Y-m-d'));
            } else {
                $startDate = Carbon::parse($request->input('start'));
                $endDate = Carbon::parse($request->input('end'));
            }
			$excludeWeb = ['allweb' => 'all'];
            $websites = array_diff(config('top10articles.web'), $excludeWeb);
            $lenDays = $endDate->diffInDays($startDate);
            for ($a=0; $a<=$lenDays; $a++) {
                echo '>>>> TGL '.$startDate.' <<<<'."\n";
                $period = new Period($startDate, $startDate);
                if ($platform == 'web') {
                    $filters = config('top10articles.topPushArticles_filter.'.$channel);
                    foreach ($websites as $dev => $devices) {
                        $webTopArticle = $this->dailyGetData(
                            $period,
                            $platform,
                            $dev,
                            $channel,
                            $filters[$devices]
                        );
						echo 'Filter Query: '. $filters[$devices] . "\n";
                        foreach ($webTopArticle as $dataArticle) {
                            if (!$this->dailyHasData($dataArticle['date'],$dev,$channel,$dataArticle['pageTitle'])) {
                                echo 'Push data '. $dataArticle['date'].' '.$dev.' '.$channel.' '.$dataArticle['pageTitle']."\n";
                                $this->dailyPushData($dataArticle);
                            } elseif ($this->dailyLessData($dataArticle['date'],$dev,$channel, $dataArticle['visitors'],$dataArticle['pageviews'],$dataArticle['pageTitle']))
 {
                                echo 'Update data '.$dataArticle['date'].' '.$dev.' '.$channel." ".$dataArticle['pageTitle']."\n";
                                $this->dailyUpdateData($dataArticle);
                            } else {
                                echo 'Data '.$dataArticle['date'].' '.$dev.' '.$channel." ".$dataArticle['pageTitle'].' OK'."\n";
                            }
                        }
                    }
                } else {
                    $filter_idx = str_replace($platform, 'apps_', $platform) . $channel;
                    $filters = config('top10articles.topPushArticles_filter.'.$filter_idx);
                    $appsTopArticle = $this->dailyGetData(
                        $period,
                        $platform,
                        $platform,
                        $channel,
                        $filters

                    );
					 echo 'Filter Query: '. $filters . "\n";
					 foreach($appsTopArticle as $dataArticle) {
                        if (!$this->dailyHasData($dataArticle['date'],$platform,$channel,$dataArticle['pageTitle'])) {
                            echo 'Push data '. $dataArticle['date'].' '.$platform." ". $channel." ".$dataArticle['pageTitle']."\n";
                            $this->dailyPushData($dataArticle);
                        } elseif ($this->dailyLessData($dataArticle['date'],$platform,$channel, $dataArticle['visitors'],$dataArticle['pageviews'],$dataArticle['pageTitle'])
) {
                            echo 'Update data '.$dataArticle['date'].' '.$platform." ". $channel." ".$dataArticle['pageTitle']."\n";
                            $this->dailyUpdateData($dataArticle);
                        } else {
                            echo 'Data '.$dataArticle['date'].' '.$platform." ". $channel." ".$dataArticle['pageTitle'].' OK'."\n";
                        }
                    }
                }
                $startDate->addDay();
            }
        } else {
            echo "Bad Request!!!";
        }
    }
	/* Pull Push Notification Top Articles*/
}
