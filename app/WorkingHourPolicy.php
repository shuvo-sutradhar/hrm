<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHourPolicy extends Model
{
    //
    protected $fillable = [
    	'name','workingHour','workingHoliday','comment'
    ];
}
