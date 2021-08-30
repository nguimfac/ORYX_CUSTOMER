<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('subscription', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client');
            $table->unsignedBigInteger('logiciel_id');
            $table->foreign('logiciel_id')->references('id')->on('logiciel');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('type_payement')->nullable();
            $table->double('a_payer')->default(0)->nullable();
            $table->double('paye')->default('0')->nullable();;
            $table->boolean('alert')->default(false);
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
        Schema::dropIfExists('subscription');
    }
}
