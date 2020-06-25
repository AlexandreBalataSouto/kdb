<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosKaratecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_karatecas', function (Blueprint $table) {
            $table->string('curso_id',5);
            $table->foreign('curso_id')->references('id_curso')->on('cursos');
            $table->smallInteger('karateca_id')->unsigned();
            $table->foreign('karateca_id')->references('id_karateca')->on('karatecas');
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
        Schema::dropIfExists('cursos_karatecas');
    }
}
