<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChemicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemicals', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('chem_type')->unsigned();
            $table->foreign('chem_type')->references('id')->on('chemtypes');
			$table->string('trade_name');
			$table->string('components');
			$table->string('rates');
			$table->integer('withhold_period');
			$table->string('pest_disease');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chemicals');
    }
}
