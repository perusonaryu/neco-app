<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','cat_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function cat(){
        return $this->belongsTo('App\Cat');
    }
}
