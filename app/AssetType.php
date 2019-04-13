<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    //
    protected $fillable = [
        'name','description'
    ];


    public function equipment()
    {
        return $this->hasMany('App\Equipment');
    }


}
