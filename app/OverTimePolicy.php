<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OverTimePolicy extends Model
{
    //
    protected $fillable = [
        'name','willPay','isDay','dayHours','isWeek','weekHours','rate','comment'
    ];
}
