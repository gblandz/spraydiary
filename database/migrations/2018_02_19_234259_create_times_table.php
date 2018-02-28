<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->integer('block_id')->unsigned();
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->string('sheds');
            $table->integer('chemical_id')->unsigned();
            $table->integer('chemical_id')->references('id')->on('chemicals');
            $table->integer('tank_capacity');
            $table->integer('total_liquid');
            $table->string('sprayed_by');
            $table->string('is_fruiting');
            $table->string('audit_check');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
