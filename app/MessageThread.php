<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model
{
    //
    protected $guarded = [];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ad(){
        return $this->belongsTo(Ad::class);
    }

    public function get_unread(){
        return $this->hasMany(Message::class)->whereNull('read_at')->where('to_user_id', '=', \Auth::id());
    }
}
