<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    //
    protected $fillable = [
    	'user_id','initialPoints','currentPoints','lastPoints','editType','performanceComment'
    ];

    public function employee()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
