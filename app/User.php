<?php

namespace App;

use App\Models\Ad;
use App\Models\Cv\CvRequest;
use App\Models\Meta;
use App\Models\Search;
use Illuminate\Support\Facades\App;
use App\Admin\jobs\JobPreference;
use App\Models\AllowedCompanyAd;
use App\Models\Company;
use App\Models\Following;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use EntrustUserTrait  { restore as private restoreA; }
    use SoftDeletes  { restore as private restoreB; }

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
        'image_path',
        'position',
        'created_by_company_id',
        'email_verified_at'
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

    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }

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

    //user meta
    public function metas(){
        return $this->morphMany('App\Models\Meta', 'metable');
    }

    //get notification meta against a key
    public function notification_meta($key){
        return Meta::where('metable_id',$this->id)->where('metable_type','App\User')->where('key',$key)->first();
    }

    //User account setting emails
    public function email_meta(){
        return $this->morphMany('App\Models\Meta', 'metable')->where('key','account_setting_alt_email');
    }

    //User account setting contact numbers
    public function contact_no_meta(){
        return $this->morphMany('App\Models\Meta', 'metable')->where('key','account_setting_alt_contact_no');
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
        return $this->hasMany(Company::class)->where('company_type', '=', 'Jobb');
    }

    public function property_companies(){
        return $this->hasMany(Company::class)->where('company_type', '=', 'Eiendom');
    }

    public function followings(){
        return $this->hasMany(Following::class);
    }
//    public function job_followings(){
//        return $this->hasMany(Following::class)->where('');
//    }
    public function saved_searches(){
        return $this->hasMany(Search::class)->where('type', '=', 'saved')->orderBy('id', 'desc');
    }
    public function recent_searches(){
        return $this->hasMany(Search::class)->where('type', '=', 'recent')->orderBy('id', 'desc');
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
    public function header_unread_notifications()
    {
        return $this->hasMany(Notification::class)->whereNull('secondary_read_at');
    }
    public function unread_notifications()
    {
        return $this->hasMany(Notification::class)->whereNull('read_at');
    }
    public function read_notifications()
    {
        return $this->hasMany(Notification::class)->whereNotNull('read_at');
    }

    //Get user ads
    public function ads(){
        return $this->hasMany(Ad::class);
    }

    //Get user request (those request that has been received by companies)
    public function requests_received(){
        return $this->hasMany(CvRequest::class,'user_id','id');
    }

    //Get user request (those request that has been received by companies)
    public function requests_sent(){
        return $this->hasMany(CvRequest::class,'employer_id','id');
    }

    //Get user request (those request that has been received by companies)
    public function cv_requests_sent(){
        return CvRequest::where('user_id',$this->id)->where('employer_id',Auth::id())->first();
    }

    //Company Agents
    public function created_by_company(){
        return $this->belongsTo(Company::class,'created_by_company_id','id');
    }

    //get user comapnies agents using hasmany through relations
    public function companies_agents(){
        //Reference link => https://laravel.com/docs/7.x/eloquent-relationships
        return $this->hasManyThrough(User::class,Company::class,'user_id','created_by_company_id','id','id');
    }

    //get user received ratings
    public function received_ratings(){
        return $this->hasMany(UserRatingReview::class,'to_user_id','id')->orderBy('id','DESC');
    }

    //get user received ratings
    public function give_ratings(){
        return $this->hasMany(UserRatingReview::class,'from_user_id','id')->orderBy('id','DESC');
    }

    // User job preference cities
    public function job_preference_cities(){
        return $this->hasMany(JobPreferenceCity::class);
    }

    // User job preference key words
    public function job_preference_key_words(){
        return $this->hasMany(JobPreferenceKeyWord::class);
    }

    //user buys ad (those ads that will be mark as sold and seller select the user)
    public function buy_ads() {
        return $this->belongsToMany(Ad::class,'ad_sold_to_user','user_id','ad_id');
    }
}
