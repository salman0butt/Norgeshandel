<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;

class CvMeta extends Model
{
    //key=>['cv','apply_job']
    protected $table = 'cv_metas';
    protected $guarded = [];

}
