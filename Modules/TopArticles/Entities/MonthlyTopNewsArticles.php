<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopNewsArticles extends Model
{
	protected $table = 'ga_monthlytopnewsarticles';

    protected $fillable = [
        'monthYear',
        'year',
        'devices',
		'channels',
        'visitors',
        'pageviews',
        'pagetitle'
	];
}
