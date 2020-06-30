<?php

namespace App\DbModels\bbs;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
    ];

    public function post()
    {
        return $this->belongsTo('App\DbModels\bbs\Post');
    }
}
