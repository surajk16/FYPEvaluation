<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idx');
            $table->integer('actual_label');
            $table->integer('predicted_label');
            $table->integer('with_anchor');
            $table->integer('without_anchor');
            $table->float('without_anchor_reaction_time');
            $table->float('with_anchor_reaction_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evaluations');
    }
}
