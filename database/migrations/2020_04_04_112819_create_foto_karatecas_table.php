<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoKaratecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_karatecas', function (Blueprint $table) {
            $table->smallIncrements('id_foto_karateca');
            $table->string('titulo',50);
            $table->string('path',100);

            $table->unsignedSmallInteger('karateca_id');
            $table->foreign('karateca_id')->references('id_karateca')->on('karatecas')->onDetele('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('fotos_karatecas');
    }
}
