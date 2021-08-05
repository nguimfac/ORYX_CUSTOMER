<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclammationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclammation', function (Blueprint $table) {
            $table->id();
            $table->string('titre_rec',100);
            $table->string('description_pb');
            $table->unsignedBigInteger('logiciel_id');
            $table->foreign('logiciel_id')->references('id')->on('logiciel');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client');
            $table->string('solution',300)->default('En attente de resolution ')->nullable();
            $table->string('etat')->default('ouvert');
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
        Schema::dropIfExists('reclammation');
    }
}
