<?php

namespace App\Models;

use App\Notification;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $guarded = [];

    public function notifications(){
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('id', 'desc');
    }
}
