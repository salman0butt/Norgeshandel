<?php

namespace App;

use App\Admin\Jobs\Job;
use App\Models\Cv\Cv;
use App\Models\Cv\CvMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function meta(){
        return $this->hasOne(CvMeta::class,'value','id')->where('key','apply_job')->where('user_id',Auth::id());
    }

}
