<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $table = 'user_packages';
    protected $guarded =[];

    //user packages belongs to package
    public function package(){
        return $this->belongsTo(Package::class);
    }

    //user packages belongs to user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
