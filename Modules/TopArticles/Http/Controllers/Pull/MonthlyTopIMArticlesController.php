<?php

namespace Modules\TopArticles\Http\Controllers\Pull;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\TopArticles\Entities\MonthlyTopIMArticles;
use Modules\TopArticles\Helpers\TopIMArticlesHelper;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use Date;

class MonthlyTopIMArticlesController extends Controller
{
	/* B: Store Monthly IM Article */
    protected function monthlyStore(
        String $monthYear,
        String $year,
        string $devices,
        String $channels,
        int $visitors,
        int $pageviews,
        String $inmarket,
        String $title)
    {
        $gaSNArticles = new MonthlyTopIMArticles();
        $gaSNArticles->monthYear = $monthYear;
        $gaSNArticles->year = $year;
        $gaSNArticles->devices = $devices;
        $gaSNArticles->channels = $channels;
        $gaSNArticles->visitors = $visitors;
        $gaSNArticles->pageviews = $pageviews;
        $gaSNArticles->inmarket = $inmarket;
        $gaSNArticles->pagetitle = $title;
        $gaSNArticles->save();
    }
    /* E: Store Monthly IM Article */

    /* B: Update Monthly IM Articles */
    protected function monthlyUpdate(
        String $month,
        String $year,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $inmarket,
        String $title)
    {
        $gaSNArticles = MonthlyTopIMArticles::where([
            'monthYear' => $month,
            'year' => $year,
            'devices' => $devices,
            'channels' => $channels,
            'inmarket' => $inmarket,
            'pageTitle' => $title,
        ])->update([
            'visitors' => $visitors,
            'pageviews' => $pageviews,
        ]);
    }
    /* E: Update Monthly IM Articles */
	
	/* B: Monthly Check Has Data Top Articles*/
    protected function monthlyHasData(String $month, String $devices, String $channels, String $inmarket, String $title)
    {
        $datas = MonthlyTopIMArticles::where([
            'monthYear' => $month,
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
    /* E: Monthly Check Has Data Top Articles*/

    /* B: Monthly Check Less IM Top Articles*/
    protected function monthlyLessData(
        String $month,
        String $year,
        String $devices,
        String $channels,
        Int $visitors,
        Int $pageviews,
        String $inmarket,
        String $title)
    {
        $datas = MonthlyTopIMArticles::where([
            'monthYear' => $month,
            'year' => $year,
            'devices' => $devices,
            'channels' => $channels,
            'inmarket' => $inmarket,
            'pageTitle' => $title,
        ])->first();
        if (($datas['visitors'] < $visitors) || ($datas['pageviews'] < $pageviews))
            return true;
        else
            return false;
    }
    /* E: Monthly Check Less IM Top Articles*/

    /* B: Get Monthly IM Top Articles */
    public function monthlyGetData(Period $period, String $platform, String $devices, String $inmarket, String $channels=NULL, String $filters=NULL)
    {
        $getQuery = new TopIMArticlesHelper();
        switch ($platform) {
            case 'android' : $data = $getQuery->androidTopIMArticlesMonthly($period, $devices, $inmarket, $channels, $filters);
                break;
            case 'ios' : $data = $getQuery->iosTopIMArticlesMonthly($period, $devices, $inmarket, $channels, $filters);
                break;
            default : $data = $getQuery->webTopIMArticlesMonthly($period, $devices, $inmarket, $channels, $filters);
        }
        return $data;
    }
    /* E: Get Monthly IM Top Articles*/
	
	/* B: Push Monthly IM Top Articles */
    public function monthlyPushData($data)
    {
        $this->monthlyStore(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['inmarket'],
            $data['pageTitle']
        );
    }
    /* End of Push Monthly IM Top Articles */

    /* B: Update Monthly IM Top Articles */
    public function monthlyUpdateData($data)
    {
        $this->monthlyUpdate(
            $data['month'],
            $data['year'],
            $data['devices'],
            $data['channels'],
            $data['visitors'],
            $data['pageviews'],
            $data['inmarket'],
            $data['pageTitle']
        );
    }
    /* E: Update Monthly IM Top Articles */

	/* B: Pull Monthly Data from Google */
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
            $inmarketName = config('inboundmarketing.IM_name');
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
                    $filters = config('inboundmarketing.IM_filter.'.$channel);
                    foreach ($websites as $dev => $devices) {
                        foreach ($inmarketName as $names => $datas) {
                            $comFilter = ';'.$datas['filter'];
                            $webSNArticle = $this->monthlyGetData(
                                $period,
                                $platform,
                                $dev,
								$names,
                                $channel,
                                $filters[$devices].$comFilter
                            );

                            echo $filters[$devices].$comFilter . "\n";
                            foreach ($webSNArticle as $dataArticle) {
                                if (!$this->monthlyHasData($dataArticle['month'],$dev,$channel,$dataArticle['inmarket'],$dataArticle['pageTitle'])) {
                                    echo 'Push data '. $dataArticle['month'].' '.$dev.' '.$channel.' '.$dataArticle['inmarket'].' '. $dataArticle['pageTitle']."\n";
                                    $this->monthlyPushData($dataArticle);
                                } elseif ($this->monthlyLessData($dataArticle['month'],$dataArticle['year'],$dataArticle['devices'],$dataArticle['channels'],$dataArticle['visitors'], $dataArticle['pageviews'], $dataArticle['inmarket'], $dataArticle['pageTitle'])) {
                                    echo 'Update data '.$dataArticle['month'].' '.$dev.' '.$channel." ".$dataArticle['inmarket'].' '.$dataArticle['pageTitle']."\n";
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
