<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyTopIMArticles extends Model
{
    protected $table = 'ga_topimarticles';
    protected $fillable = [
        'date',
        'dayDate',
        'dayName',
        'weekYear',
        'monthYear',
        'year',
        'visitors',
        'pageviews',
        'inmarket',
        'pagetitle',
        'devices',
        'channels'
    ];

}
