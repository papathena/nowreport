<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyTopPushArticles extends Model
{
	protected $table = 'ga_toppusharticles';
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
