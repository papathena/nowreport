<?php

namespace Modules\Traffics\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyTraffics extends Model
{
    protected $table = 'ga_traffics';
    protected $primaryKey = 'date';
    protected $fillable = [
    	'date', 
    	'dayDate', 
    	'dayName',
    	'weekYear',
    	'monthYear',
    	'year',
    	'visitors', 
        'pageviews',
    	'devices', 
        'channels',
    ];
}
