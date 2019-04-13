<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    //
    protected $fillable = [
        'name','employee_id','equipment_id','details'
    ];

    public function employee()
    {
        return $this->belongsTo('App\User');
    }

    public function equipment()
    {
        return $this->belongsTo('App\Equipment');
    }
}
