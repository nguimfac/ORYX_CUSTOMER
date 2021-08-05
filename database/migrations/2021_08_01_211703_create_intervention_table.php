<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention', function (Blueprint $table) {
            $table->id();
            $table->string('tache');
            $table->unsignedBigInteger('reclammation_id');
            $table->string('intervenant');
            $table->string('cout')->nullable();
            $table->foreign('reclammation_id')->references('id')->on('reclammation');
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
        Schema::dropIfExists('intervention');
    }
}
