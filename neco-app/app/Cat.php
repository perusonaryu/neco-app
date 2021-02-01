<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cat extends Model
{
    protected $fillable = [
        'name','age','color','image','personality','user_id'
    ];

    protected $table = 'cats';
}
