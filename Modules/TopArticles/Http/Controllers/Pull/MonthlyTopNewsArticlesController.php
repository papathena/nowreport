<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\MonthlyTopNewsArticles;
use Modules\TopArticles\Helpers\TopNewsArticlesHelper;
use Carbon\Carbon;
use Spatie\Analytics\Period;

class MonthlyTopNewsArticlesController extends Controller
{
	/* B: Store Monthly Data */
    protected function monthlyStore(
        String $monthYear,
        String $year,
        string $devices,
        String $channels,
        int $visitors,
        int $pageviews,
        String $title)
    {
        $gatoparticles = new MonthlyTopNewsArticles();
        $gatoparticles->monthYear = $monthYear;
        $gatoparticles->year = $year;
        $gatoparticles->devices = $devices;
        $gatoparticles->channels = $channels;
        $gatoparticles->visitors = $visitors;
        $gatoparticles->pageviews = $pageviews;
        $gatoparticles->pagetitle = $title;
        $gatoparticles->save();
    }
    /* E: Store Monthly Data */
	
	/* B: Update Monthly Data */
    protected function MonthlyUpdate(
        String $month,
        String $year,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $title)
    {
        $gatoparticles = MonthlyTopNewsArticles::where([
            'monthYear' => $month,
            'year' => $year,
            'devices' => $devices,
            'channels' => $channels,
            'pageTitle' => $title,
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* E: Update Monthly Data */
	
	/*B: Monthly Check Has Data Top Articles*/
    protected function monthlyHasData(String $month, String $devices, String $channels, String $title)
    {
        $datas = MonthlyTopNewsArticles::where([
            'monthYear' => $month,
            'devices' => $devices,
            'channels' => $channels,
            'pagetitle' => $title,
        ])->first();
        if (is_null($datas))
            return false;
        else
            return true;
    }
    /* E: Monthly Check Has Data Top Articles*/
	
	/* E: Monthly Check Less Data Top Articles*/
    protected function monthlyLessData(
        String $month,
        String $year,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $title)
    {
        $datas = MonthlyTopNewsArticles::where([
            'monthYear' => $month,
            'year' => $year,
            'devices' => $devices,
            'channels' => $channels,
            'pageTitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews))
            return true;
        else
            return false;
    }
    /* E: Monthly Check Less Data Top Articles*/

    /* B: Get Monthly Data */
    public function monthlyGetData(Period $period, String $platform, String $devices, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopNewsArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopNewsArticlesMonthly($period, $devices, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopNewsArticlesMonthly($period, $devices, $channels, $filters);
                break;
            default : $data = $getQuery->webTopNewsArticlesMonthly($period, $devices, $channels, $filters);
        }
        return $data;
    }
    /* E: Get Monthly Data*/
	
	/* B: Push Monthly Data */
    public function monthlyPushData($data)
    {
        $this->monthlyStore(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['pageTitle']
        );
    }
    /* E: Push Monthly Data */

    /* B: Update Monthly Data */
    public function monthlyUpdateData($data)
    {
        $this->monthlyUpdate(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['pageTitle']
        );
    }
    /* E: Update Monthly Data */
	
	/* B: Pull Monthly Data from Google */
    public function monthlyPull(Request $request)
    {
        if ($request->isMethod('get')) {
            $platform = $request->input('platform');
            $channel = $request->input('channel');
            if (is_null($request->input('start')) || is_null($request->input('end'))) {
                $startDate = Carbon::parse(Carbon::now()->subMonths(2)->format('Y-m-d'));
                $endDate = Carbon::parse(Carbon::now()->format('Y-m-d'));
            } else {
                $startDate = Carbon::parse($request->input('start'));
                $endDate = Carbon::parse($request->input('end'));
            }

            $startMonth = $startDate->format('m');
            $endMonth = $endDate->format('m');
            $websites = config('top10articles.web');
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
                    $filters = config('top10articles.topTextArticles_filter.'.$channel);
                    foreach ($websites as $key => $devices) {
                        $webTopArticle = $this->monthlyGetData(
                            $period,
                            $platform,
                            $key,
                            $channel,
                            $filters[$devices]
                        );

						echo $filters[$devices] . "\n";
                        foreach ($webTopArticle as $dataArticle) {
                            if (!$this->monthlyHasData($dataArticle['month'],$key,$channel,$dataArticle['pageTitle'])) {
                                echo 'Push data '. $dataArticle['month'].' '.$key.' '.$channel.' '.$dataArticle['pageTitle']."\n";
                                $this->monthlyPushData($dataArticle);
                            } elseif ($this->monthlyLessData($dataArticle['month'],$dataArticle['year'],$dataArticle['devices'],$dataArticle['channels'],$dataArticle['visitors'], $dataArticle['pageviews'], $dataArticle['pageTitle'])) {
                                echo 'Update data '.$dataArticle['month'].' '.$key.' '.$channel." ".$dataArticle['pageTitle']."\n";
                                $this->monthlyUpdateData($dataArticle);
                            } else {
                                echo 'Data '.$dataArticle['month'].' '.$key.' '.$channel." ".$dataArticle['pageTitle'].' OK'."\n";
                            }
                        }
                    }
                } else {
                    $filter_idx = str_replace($platform, 'apps_', $platform) . $channel;
                    $filters = config('top10articles.topTextArticles_filter.'.$filter_idx);
                    $appsTopArticle = $this->monthlyGetData(
                        $period,
                        $platform,
                        $platform,
                        $channel,
                        $filters
                    );
					echo $filters . "\n";
                    foreach($appsTopArticle as $dataArticle) {
                        if (!$this->monthlyHasData($dataArticle['month'],$platform,$channel,$dataArticle['pageTitle'])) {
                            echo 'Push data '. $dataArticle['month'].' '.$platform." ". $channel." ".$dataArticle['pageTitle']."\n";
                            $this->monthlyPushData($dataArticle);
                        } elseif ($this->monthlyLessData($dataArticle['month'],$dataArticle['year'],$platform,$channel, $dataArticle['visitors'], $dataArticle['pageviews'], $dataArticle['pageTitle'])) {
                            echo 'Update data '.$dataArticle['month'].' '.$platform." ". $channel." ".$dataArticle['pageTitle']."\n";
                            $this->monthlyUpdateData($dataArticle);
                        } else {
                            echo 'Data '.$dataArticle['month'].' '.$platform." ". $channel." ".$dataArticle['pageTitle'].' OK'."\n";
                        }
                    }
                }
                $startDate->addMonth();
            }
        } else {
            echo "Bad Request!!!";
        }
    }
    /* E: Pull Monthly Data from Google */
}
