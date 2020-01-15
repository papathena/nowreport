<?php

namespace Modules\Achievement\Entities;

use Illuminate\Database\Eloquent\Model;

class AchievementTarget extends Model
{
    protected $table = 'achievement';
    protected $fillable = [
        'channel',
        'year',
        'uvtarget',
        'pvtarget',
    ];
}
