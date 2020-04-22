<?php

namespace App\Models\Cv;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CvRequest extends Model
{
    protected $table = 'cv_requests';
    protected $guarded = [];

    //Status[requested, approved, rejected]
    
    
    public function employer(){
        return $this->belongsTo(User::class,'employer_id','id');
    }
}
