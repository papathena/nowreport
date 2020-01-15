<?php

namespace Modules\Traffics\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTraffics extends Model
{
	protected $table = 'ga_monthlytraffics';
    protected $fillable = [
    	'monthYear',
    	'year',
    	'visitors', 
        'pageviews',
    	'devices', 
        'channels',
        'create_at', 
        'update_at'
    ];
}
