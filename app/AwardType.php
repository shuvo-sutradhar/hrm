<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardType extends Model
{
    //
    //
    protected $fillable = [
        'name','status','description'
    ];


    public function award()
    {
        return $this->hasMany('App\Award');
    }
}
