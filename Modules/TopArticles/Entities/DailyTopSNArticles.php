<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyTopSNArticles extends Model
{
	protected $table = 'ga_topsnarticles';
    protected $fillable = [
    	'date', 
    	'dayDate', 
    	'dayName',
    	'weekYear',
    	'monthYear',
    	'year',
        'visitors',
    	'pageviews',
        'sosnet',
        'pagetitle',
    	'devices', 
        'channels'
    ];

}
