<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;

class CvRequest extends Model
{
    protected $table = 'cv_requests';
    protected $guarded = [];

    //Status[requested, approved, rejected]
}
