<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_generals', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('num_refere')->unique()->nullable();
            $table->unsignedBigInteger('num_civile')->unique()->nullable();
            $table->primary('id_role');
            $table->foreign('num_refere')->references('id')->on('referes')->onDelete('cascade');
            $table->foreign('num_civile')->references('id')->on('civiles')->onDelete('cascade');
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
        Schema::dropIfExists('role_generals');
    }
}
