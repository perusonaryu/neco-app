<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cat extends Model
{
    protected $fillable = [
        'id','name','age','color','image','personality','user_id','gender'
    ];

    protected $table = 'cats';
}
