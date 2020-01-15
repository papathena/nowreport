<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyTopCSArticles extends Model
{
	protected $table = 'ga_topcsarticles';

    protected $fillable = [
    	'date', 
    	'dayDate', 
    	'dayName',
    	'weekYear',
    	'monthYear',
    	'year',
        'visitors',
    	'pageviews',
		'chgroup',
        'pagetitle',
    	'devices',
    	'channels'
    ];
}
