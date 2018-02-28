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
            $table->integer('block_id')->unsigned();            
            $table->string('sheds');
            $table->integer('chemical_id')->unsigned();            
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

        Schema::table('times', function(Blueprint $table)
        {
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('chemical_id')->references('id')->on('chemicals');
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
