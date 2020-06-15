<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class UserRatingReview extends Model
{

    protected $table = 'user_rating_reviews';
    protected $guarded = [];

    //get ad
    public function ad(){
        return $this->belongsTo(Ad::class);
    }

    //
    public function from_user(){
        return $this->belongsTo(User::class,'from_user_id','id');
    }

    public function to_user(){
        return $this->belongsTo(User::class,'to_user_id','id');

    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('id', 'desc');
    }

}
