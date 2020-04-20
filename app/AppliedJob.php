<?php

namespace App;

use App\Admin\Jobs\Job;
use App\Models\Cv\Cv;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $table = 'applied_jobs';
    protected $guarded = [];

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

    public function cv(){
        return $this->hasOne(Cv::class,'apply_job_id','id');
    }

}
