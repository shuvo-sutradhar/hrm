<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    //
    protected $fillable = [
        'apply_date','employee_id','leave_id','duration','start_date','end_date','hours','reason','attachment','status','status_change_by'
    ];


    public function employee()
    {
        return $this->belongsTo('App\User');
    }


    public function leave()
    {
        return $this->belongsTo('App\Leave');
    }

}
