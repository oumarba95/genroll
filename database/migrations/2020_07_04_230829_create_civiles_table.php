<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civiles', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->integer('civile_type_id');
            $table->string('demandeur');
            $table->string('defendeur')->nullable();
            $table->dateTime('date_requete');
            $table->text('motifs');
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
        Schema::dropIfExists('civiles');
    }
}
