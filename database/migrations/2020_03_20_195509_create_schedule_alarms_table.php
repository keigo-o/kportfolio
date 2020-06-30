<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_alarms', function (Blueprint $table) {
            $table->bigIncrements('alarm_id');
            $table->unsignedBigInteger('input_id');
            $table->date('start_day');
            $table->integer('serialnum')->increment();
            $table->string('title', 30);
            $table->time('start_time');
            $table->time('alarm')->nullable();
            $table->date('snooze')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('input_id')->references('input_id')->on('notebook_inputs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_alarms');
    }
}
