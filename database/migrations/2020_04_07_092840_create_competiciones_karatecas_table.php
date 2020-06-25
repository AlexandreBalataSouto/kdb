<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompeticionesKaratecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competiciones_karatecas', function (Blueprint $table) {
            $table->string('competicion_id',5);
            $table->foreign('competicion_id')->references('id_competicion')->on('competiciones');
            $table->smallInteger('karateca_id')->unsigned();
            $table->foreign('karateca_id')->references('id_karateca')->on('karatecas');
            $table->string('puesto',10)->nullable();

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
        Schema::dropIfExists('competiciones_karatecas');
    }
}
