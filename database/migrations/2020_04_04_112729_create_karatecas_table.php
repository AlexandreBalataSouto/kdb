<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaratecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karatecas', function (Blueprint $table) {
            $table->smallIncrements('id_karateca');
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->date('fecha_nacimiento');
            $table->string('dni', 10);
            $table->string('direccion', 100);
            $table->string('codigo_postal', 10);
            $table->string('municipio', 20);
            $table->string('telefono_fijo', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nombre_madre_movil', 50)->nullable();
            $table->string('nombre_padre_movil', 50)->nullable();
            $table->string('movil_alumno', 20)->nullable();
            $table->date('fecha_alta');
            $table->string('peso', 10)->nullable();
            $table->string('altura', 10)->nullable();
            $table->string('genero', 5);
            $table->tinyInteger('edad')->nullable();
            $table->text('observaciones')->nullable();

            $table->unsignedSmallInteger('monitor_id');
            $table->foreign('monitor_id')->references('id_monitor')->on('monitores');

            $table->unsignedSmallInteger('categoria_id');
            $table->foreign('categoria_id')->references('id_categoria')->on('categorias');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karatecas');
    }
}
