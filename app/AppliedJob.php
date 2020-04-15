<?php

namespace App;

use App\Admin\Jobs\Job;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $table = 'applied_jobs';
    protected $guarded = [];

    public function setDobAttribute($value)
    {
        if($value){
            return $this->attributes['dob'] = date('Y-m-d',strtotime($value));
        }else{
            return $this->attributes['dob'] = null;
        }
    }

    public function getDobAttribute()
    {
        if(!$this->attributes['dob']){
            return '';
        }
        return date('d-m-Y', strtotime($this->attributes['dob']));
    }

    public function media(){
        return $this->morphOne(Media::class, 'mediable');//->where('type','applied_job_cv');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

}
