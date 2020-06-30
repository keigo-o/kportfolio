<?php

namespace App\DbModels\notebook;

use Illuminate\Database\Eloquent\Model;

class PublicHoliday extends Model
{
    protected $fillable = [
        'date', 'name',
    ];
}
