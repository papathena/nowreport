<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopPushArticles extends Model
{
	protected $table = 'ga_monthlytoppusharticles';
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
