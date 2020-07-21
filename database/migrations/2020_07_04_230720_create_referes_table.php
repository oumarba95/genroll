<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referes', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('demandeur');
            $table->string('defendeur');
            $table->dateTime('date_requete');
            $table->text('motif_assignation');
            $table->dateTime('date_audience');
            $table->unsignedBigInteger('numero_quittance')->unique()->nullable();
            $table->primary('id');
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
        Schema::dropIfExists('referes');
    }
}
