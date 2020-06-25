<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->string('id_curso',5)->primary(); //Id + numero
            $table->smallInteger('numero');

            $table->string('title',50);
            $table->date('start');
            $table->date('end');
            $table->string('hora',20);
            $table->text('descripcion')->nullable();
            $table->float('precio')->nullable();
            $table->string('color',30);
            $table->string('text_color',30);

            $table->unsignedSmallInteger('monitor_id');
            $table->foreign('monitor_id')->references('id_monitor')->on('monitores');

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
        Schema::dropIfExists('cursos');
    }
}
