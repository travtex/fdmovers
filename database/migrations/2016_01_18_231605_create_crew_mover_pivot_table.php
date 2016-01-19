<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewMoverPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_mover', function (Blueprint $table) {
            $table->integer('crew_id')->unsigned()->index();
            $table->foreign('crew_id')->references('id')->on('crews')->onDelete('cascade');
            $table->integer('mover_id')->unsigned()->index();
            $table->foreign('mover_id')->references('id')->on('movers')->onDelete('cascade');
            $table->primary(['crew_id', 'mover_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crew_mover');
    }
}
