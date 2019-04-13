<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes,Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

     protected $guard_name = 'web'; // or whatever guard you want to use

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'deleted_at','slug',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function asset_assign()
    {
        return $this->hasMany('App\AssetAssignment');
    }


    public function performance()
    {
        return $this->hasMany('App\Performance');
    }

    public function award()
    {
        return $this->hasMany('App\Award');
    }

    public function leaveRequest()
    {
        return $this->hasMany('App\LeaveRequest');
    }

    public function loanRequest()
    {
        return $this->hasMany('App\LoanRequest');
    }

    public function advanceRequest()
    {
        return $this->hasMany('App\AdvanceRequest');
    }

    // public function isAdmin()
    // {
    //     return $this->account_role == 1 ? true : false;
    // }
}
