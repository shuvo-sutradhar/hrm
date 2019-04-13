<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvanceRequest extends Model
{
    //
    protected $fillable = [
        'employee_id','apply_date','request_amount','month','year','status','comment','status_change_by'
    ];

    
    public function employee()
    {
        return $this->belongsTo('App\User');
    }
}
