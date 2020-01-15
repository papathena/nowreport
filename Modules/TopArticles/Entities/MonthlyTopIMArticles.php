<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopIMArticles extends Model
{
    protected $table = 'ga_monthlytopimarticles';

    protected $fillable = [
        'monthYear',
        'year',
        'devices',
        'channels',
        'visitors',
        'inmarket',
        'pageviews',
        'pagetitle'
    ];
}
