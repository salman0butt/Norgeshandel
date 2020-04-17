<?php

namespace App\Admin\Jobs;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'title',
        'status',
        'positions',
        'job_type',
        'commitment_type',
        'sector',
        'industry',
        'job_function',
        'keywords',
        'description',
        'deadline',
        'accession',
        'emp_name',
        'emp_company_information',
        'emp_website',
        'emp_facebook',
        'emp_linkedin',
        'emp_twitter',
        'country',
        'zip',
        'zip_city',
        'address',
        'workplace_video',
        'app_receive_by',
        'app_link_to_receive',
        'app_email_to_receive',
        'app_contact',
        'app_contact_title',
        'app_mobile',
        'app_phone',
        'app_email',
        'app_linkedin',
        'app_twitter',
        'created_at',
        'updated_at',
        'user_id',
        'company_id',
        'slug',
        'leadership_category'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

//    public function media(){
//        return $this->morphMany('App\Media', 'mediable');
//    }
//
//    public function company_logo(){
//        return $this->morphMany('App\Media', 'mediable')->where('type','company_logo');
//    }
//
//    public function company_gallery(){
//        return $this->morphMany('App\Media', 'mediable')->where('type','company_gallery')->orderBy('order','ASC');
//    }
//    public function gallery(){
//        return $this->morphMany('App\Media', 'mediable')->where('type','gallery');
//    }


    public function terms(){
        return $this->belongsToMany('App\Term');
    }

    public function ad(){
        return $this->belongsTo('App\Models\Ad');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
//    public function meta(){
//        return $this->hasMany('App\Admin\Jobs\JobMeta');
//    }
}
