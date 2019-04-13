<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    //
	protected $fillable = [
		'type_name','type_desc'
	];
}
