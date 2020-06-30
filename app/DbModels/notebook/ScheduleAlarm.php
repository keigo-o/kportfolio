<?php

namespace App\DbModels\notebook;

use Illuminate\Database\Eloquent\Model;

class ScheduleAlarm extends Model
{
    protected $primaryKey = "alarm_id";
    protected $guarded = array('alarm_id');




        public function notebookinput()
    {
        return $this->belongsTo('App\DbModels\notebook\NotebookInput');
    }
}
