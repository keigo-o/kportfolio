<?php

namespace App\DbModels\bbs;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public function comments()
    {
        return $this->hasMany('App\DbModels\bbs\Comment');
    }
}
