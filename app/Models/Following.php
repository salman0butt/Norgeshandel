<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $guarded = [];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
