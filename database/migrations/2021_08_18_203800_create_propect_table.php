<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propect', function (Blueprint $table) {
            $table->id();
            $table->string('nom',50);
          //  $table->string('civilite',30)->nullable();
            $table->string('email',50);
            $table->string('address',50)->nullable();
            $table->string('code_postal',50)->nullable();
            $table->string('ville',50)->nullable();
            $table->integer('telephone');
            $table->unsignedBigInteger('logiciel_id');
            $table->foreign('logiciel_id')->references('id')->on('logiciel');
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
        Schema::dropIfExists('propect');
    }
}
