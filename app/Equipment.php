<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
	protected $fillable = [
		'name','asset_type_id','model','serial_no','description'
	];


	public function asset_type()
    {
        return $this->belongsTo('App\AssetType');
    }

    
    public function asset_assign()
    {
        return $this->hasMany('App\AssetAssignment');
    }
}
