<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    //
    protected $fillable = [
        'employee_id','apply_date','request_amount','installment_per_month','start_installment_date','last_installment_date','status','comment','status_change_by'
    ];



    public function employee()
    {
        return $this->belongsTo('App\User');
    }

}
