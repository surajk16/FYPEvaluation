<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_datas', function (Blueprint $table) {
            $table->integer('idx');
            $table->string('occupation');
            $table->string('race');
            $table->integer('capital_gain');
            $table->string('education');
            $table->string('country');
            $table->string('hours_per_week');
            $table->string('relationship');
            $table->string('marital_status');
            $table->string('sex');
            $table->integer('capital_loss');
            $table->string('workclass');
            $table->string('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('input_datas');
    }
}
