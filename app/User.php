<?php

namespace App;

use App\Models\Company;
use App\Admin\jobs\JobPreference;
use Illuminate\Support\Facades\App;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'mobile_number',
        'email',
        'password',
        'address',
        'city',
        'zip',
        'country',
        'birthday',
        'gender',
        'status',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function jobs(){
        return $this->hasMany('App\Admin\Jobs\Job');
    }

    public function property_for_rent()
    {
        return $this->hasMany('App\PropertyForRent','user_id');
    }

    public function media(){
        return $this->morphOne('App\Media', 'mediable');
    }

    public function cv(){
        return $this->hasOne('App\Models\Cv\Cv');
    }

    public function preference(){
        return $this->hasOne(JobPreference::class);
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }
    public function ads() {
        return $this->hasMany('App\Admin\ads\Banner');
    }
}
