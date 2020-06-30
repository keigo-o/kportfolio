<?php

namespace App\DbModels\notebook;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotebookInput extends Model
{
    use SoftDeletes;

    protected $table = 'notebook_inputs';
    protected $primaryKey = "input_id";
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schedulealarms()
    {
        return $this->hasMany('app\DbModels\notebook\ScheduleAlarm');
    }


}
