<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name', 'display_name'
        ];
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }
}
