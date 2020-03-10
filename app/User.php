<?php

namespace App;

use App\Models\Search;
use Illuminate\Support\Facades\App;
use App\Admin\jobs\JobPreference;
use App\Models\AllowedCompanyAd;
use App\Models\Company;
use App\Models\Following;
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
        'about_me',
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

//    public function setBirthdayAttribute($value)
//    {
//        if($value){
//            $this->attributes['birthday'] = date('Y-m-d',strtotime($value));
//        }else{
//            $this->attributes['birthday'] = null;
//        }
//
//    }
    public function getBirthdayAttribute() {
        if(!$this->attributes['birthday']){
            return '';
        }
        return date('d-m-Y', strtotime($this->attributes['birthday']));
    }


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
    public function banner_ads() {
        return $this->hasMany('App\Admin\ads\Banner');
    }
    public function allowed_ads(){
        return $this->hasMany(AllowedCompanyAd::class);
    }

    public function allowed_job_companies(){
        return $this->hasMany(AllowedCompanyAd::class)->where('key', '=', 'jobs');
    }

    public function allowed_property_companies(){
        return $this->hasMany(AllowedCompanyAd::class)->where('key', '=', 'properties');
    }

    public function job_companies(){
        return $this->hasMany(Company::class)->where('company_type', '=', 'job');
    }

    public function property_companies(){
        return $this->hasMany(Company::class)->where('company_type', '=', 'property');
    }

    public function followings(){
        return $this->hasMany(Following::class);
    }
//    public function job_followings(){
//        return $this->hasMany(Following::class)->where('');
//    }
    public function saved_searches(){
        return $this->hasMany(Search::class)->where('type', '=', 'saved');
    }
    public function recent_searches(){
        return $this->hasMany(Search::class)->where('type', '=', 'recent');
    }
    public function is($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }

    public function threads(){
        return $this->belongsToMany(MessageThread::class);
    }
    public function unread_messages(){
        return Message::where('to_user_id', $this->id)->whereNull('read_at')->get();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function unread_notifications()
    {
        return $this->hasMany(Notification::class)->whereNull('read_at');
    }
    public function read_notifications()
    {
        return $this->hasMany(Notification::class)->whereNotNull('read_at');
    }
}
