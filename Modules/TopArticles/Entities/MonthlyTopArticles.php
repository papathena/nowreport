<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopArticles extends Model
{
	protected $table = 'ga_monthlytoparticles';

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
