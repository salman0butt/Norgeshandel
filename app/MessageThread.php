<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MessageThread extends Model
{
    //
    protected $guarded = [];

    public function messages(){
        return $this->hasMany(Message::class)
            ->where('deleted_by', '!=', Auth::id())
            ->orWhereNull('deleted_by');
    }

    public function one_side_messages(){
        return $this->hasMany(Message::class)
            ->whereNotNull('deleted_by');
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function ad(){
        return $this->belongsTo(Ad::class);
    }

    public function get_unread(){
        return $this->hasMany(Message::class)->whereNull('read_at')->where('to_user_id', '=', \Auth::id());
    }
}
