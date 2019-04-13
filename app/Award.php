<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    //
    //
    protected $fillable = [
        'name','employee_id','award_type_id','gift','amount','month','year','award_img','description'
    ];

    public function award_type()
    {
        return $this->belongsTo('App\AwardType');
    }

    public function employee()
    {
        return $this->belongsTo('App\User');
    }
}
