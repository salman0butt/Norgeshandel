<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdView extends Model
{
    protected $fillable = ['ad_id','ip','user_id'];
}
