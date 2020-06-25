<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_monitores', function (Blueprint $table) {
            $table->smallIncrements('id_foto_monitor');
            $table->string('titulo',50);
            $table->string('path',100);

            $table->unsignedSmallInteger('monitor_id');
            $table->foreign('monitor_id')->references('id_monitor')->on('monitores');

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
        Schema::dropIfExists('fotos_monitores');
    }
}
