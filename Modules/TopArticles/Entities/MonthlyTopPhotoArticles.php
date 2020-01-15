<?php

namespace Modules\TopArticles\Entities;

use Illuminate\Database\Eloquent\Model;

class MonthlyTopPhotoArticles extends Model
{
	protected $table = 'ga_monthlytopphotoarticles';
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
