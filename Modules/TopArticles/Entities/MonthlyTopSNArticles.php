<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopSNArticles extends Model
{
    protected $table = 'ga_monthlytopsnarticles';

    protected $fillable = [
        'monthYear',
        'year',
        'devices',
        'channels',
        'visitors',
        'socnet',
        'pageviews',
        'pagetitle'
    ];

}
