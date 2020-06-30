<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnSomeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_alarms', function (Blueprint $table) {
            $table->dropColumn('start_day');
            $table->dropColumn('serialnum');
            $table->dropColumn('title');
            $table->dropColumn('start_time');
            $table->dropColumn('snooze');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_alarms', function (Blueprint $table) {
            $table->boolean('start_day')->default(false);
            $table->boolean('serialnum')->default(false);
            $table->boolean('title')->default(false);
            $table->boolean('start_time')->default(false);
            $table->boolean('snooze')->default(false);
        });
    }
}
