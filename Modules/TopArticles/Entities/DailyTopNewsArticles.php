<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyTopNewsArticles extends Model
{
	protected $table = 'ga_topnewsarticles';
    //protected $primaryKey = 'date';

    protected $fillable = [
    	'date', 
    	'dayDate', 
    	'dayName',
    	'weekYear',
    	'monthYear',
    	'year',
        'visitors',
    	'pageviews',
        'pagetitle',
    	'devices',
    	'channels'
    ];
}
