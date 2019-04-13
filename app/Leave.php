<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
	//
	protected $fillable = [
		'leave_policy_id','leaveName','leaveNumber','payFor','isApprove','color',
	];

    public function leavePolicy()
    {
        return $this->belongsTo('App\LeavePolicy');
    }


    public function leaveRequest()
    {
        return $this->hasMany('App\LeaveRequest');
    }
}
