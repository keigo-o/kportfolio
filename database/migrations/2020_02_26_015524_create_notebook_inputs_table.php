<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotebookInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notebook_inputs', function (Blueprint $table) {
            $table->bigIncrements('input_id');
            $table->unsignedBigInteger('users_id');
            $table->char('select', 1);
            $table->string('project', 30)->nullable();
            $table->string('title', 30);
            $table->date('start_day');
            $table->integer('serialnum')->increment();
            // $table->BigInteger('serialnum')->increment();
            $table->date('end_day');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('alarm')->nullable();
            $table->char('all_day', 1)->nullable();
            $table->char('importance', 1);
            $table->string('schedule', 500)->nullable();
            $table->string('memo', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notebook_inputs');
    }
}
