<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNotebookInputsTableColumnDayandtime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notebook_inputs', function (Blueprint $table) {
            $table->date('end_day')->nullable()->change();
            $table->time('start_time')->nullable()->change();
            $table->time('end_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notebook_inputs', function (Blueprint $table) {
            $table->date('end_day')->nullable(false)->change();
            $table->time('start_time')->nullable(false)->change();
            $table->time('end_time')->nullable(false)->change();
        });
    }
}
