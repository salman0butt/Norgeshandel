<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;

class CvPersonal extends Model
{
    protected $guarded = [];

    public function setBirthdayAttribute($value)
    {
        if($value){
            $this->attributes['birthday'] = date('Y-m-d',strtotime($value));
        }else{
            $this->attributes['birthday'] = null;
        }

    }
    public function getBirthdayAttribute() {
        if(!$this->attributes['birthday']){
            return '';
        }
        return date('d-m-Y', strtotime($this->attributes['birthday']));
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cv(){
        return $this->belongsTo('App\Models\Cv\Cv');
    }
}
