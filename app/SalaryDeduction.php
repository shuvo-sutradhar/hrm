<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryDeduction extends Model
{
    //
    protected $fillable = [
        'policyName','deductionForm','deductionAfter','deductionRate','deductionComment'
    ];
}
