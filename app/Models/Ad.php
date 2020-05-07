<?php

namespace App\Models;

use App\AdAgent;
use App\Admin\Jobs\Job;
use App\BusinessForSale;
use App\CommercialPlot;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use App\FlatWishesRented;
use App\Notification;
use App\PropertyForRent;
use App\PropertyForSale;
use App\PropertyHolidaysHomesForSale;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Favorite;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','status','ad_type','sold_at','published_on'
    ];

    public function media(){
        return $this->morphMany('App\Media', 'mediable');
    }

    public function company_logo(){
        return $this->morphMany('App\Media', 'mediable')->where('type','logo')->orderBy('media_order','ASC');
    }

    public function company_gallery(){
        return $this->morphMany('App\Media', 'mediable')->where('type','gallery')->orderBy('media_order','ASC');
    }

    // get complete quotation
    public function sales_information(){
        return $this->morphMany('App\Media', 'mediable')->where('type','sales_information')->orderBy('media_order','ASC');
    }

    // get sales information
    public function pdf(){
        return $this->morphMany('App\Media', 'mediable')->where('type','pdf')->orderBy('media_order','ASC');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function job(){
        return $this->hasOne('App\Admin\Jobs\Job');
    }

    public function propertyForRent(){
        return $this->hasOne('App\PropertyForRent');
    }

    public function propertyForSale(){
        return $this->hasOne('App\PropertyForSale');
    }

    public function propertyHolydaysHomesForSale(){
        return $this->hasOne('App\PropertyHolidaysHomesForSale');
    }

    public function propertyFlatWishesRented(){
        return $this->hasOne('App\FlatWishesRented');
    }

    public function propertyCommercialPropertyForSale(){
        return $this->hasOne('App\CommercialPropertyForSale');
    }
    public function propertyCommercialPropertyForRent(){
        return $this->hasOne('App\CommercialPropertyForRent');
    }
    public function propertyCommercialPlot(){
        return $this->hasOne('App\CommercialPlot');
    }
    public function propertyBusinessForSale(){
        return $this->hasOne('App\BusinessForSale');
    }

    public function getTitle($trashed_record = ''){
        if($this->ad_type == 'property_for_rent' ||
            $this->ad_type == 'property_commercial_for_rent'){
            if($trashed_record){
                return $this->property()->withTrashed()->first()->heading;
            }
            return $this->property->heading;
        }
        else if($this->ad_type == 'property_for_sale' ||
            $this->ad_type == 'property_flat_wishes_rented' ||
            $this->ad_type == 'property_commercial_for_sale' ||
            $this->ad_type == 'property_commercial_plots' ||
            $this->ad_type == 'property_business_for_sale'
        ){
            if($trashed_record){
                return $this->property()->withTrashed()->first()->headline;
            }
            return $this->property->headline;
        }
        else if($this->ad_type == 'property_holiday_home_for_sale'){
            if($trashed_record){
                return $this->property()->withTrashed()->first()->ad_headline;
            }
            return $this->property->ad_headline;
        }
        else if($this->ad_type == 'job'){
            if($trashed_record){
                return $this->job()->withTrashed()->first()->name;
            }
            return $this->job->name;
        }
        return null;

    }

    public function property(){
        if($this->ad_type == 'property_for_rent'){
            return $this->hasOne(PropertyForRent::class);
        }
        else if($this->ad_type == 'property_for_sale'){
            return $this->hasOne(PropertyForSale::class)->withTrashed();
        }
        else if($this->ad_type == 'property_holiday_home_for_sale'){
            return $this->hasOne(PropertyHolidaysHomesForSale::class)->withTrashed();
        }
        else if($this->ad_type == 'property_flat_wishes_rented'){
            return $this->hasOne(FlatWishesRented::class)->withTrashed();
        }
        else if($this->ad_type == 'property_commercial_for_sale'){
            return $this->hasOne(CommercialPropertyForSale::class)->withTrashed();
        }
        else if($this->ad_type == 'property_commercial_for_rent'){
            return $this->hasOne(CommercialPropertyForRent::class)->withTrashed();
        }
        else if($this->ad_type == 'property_commercial_plots'){
            return $this->hasOne(CommercialPlot::class)->withTrashed();
        }
        else if($this->ad_type == 'property_business_for_sale'){
            return $this->hasOne(BusinessForSale::class)->withTrashed();
        }
        return null;
    }

    public function job_filtered($filter){
        return $this->hasOne(Job::class)->where($filter)->get();
    }

    public function views(){
        return $this->hasMany(AdView::class);
    }

    public static function favorite($ad_id){
        if(\Auth::check()){
            return Favorite::where('user_id', \Auth::user()->id)->where('ad_id', $ad_id)->get();
        }
        return Favorite::where('user_id', 0)->where('ad_id', $ad_id)->get();
    }

    public function is_mine(){
        if (Auth::check()){
            if ($this->user->id==Auth::id()){
                return true;
            }
            return false;
        }
        return false;
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('id', 'desc');
    }
    public function agents() {
        return $this->belongsToMany(User::class,'ad_agents','ad_id','agent_id');
    }
    public function company() {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
