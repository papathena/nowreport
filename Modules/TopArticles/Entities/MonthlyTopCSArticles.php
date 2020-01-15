<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopCSArticles extends Model
{
    protected $table = 'ga_monthlytopcsarticles';

    protected $fillable = [
        'monthYear',
        'year',
        'devices',
		'channels',
        'visitors',
		'chgroup',
        'pageviews',
        'pagetitle'
	];
}
