<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstadoResultado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_resultado', function (Blueprint $table) {
            $table->id();
            $table->decimal('debe');
            $table->decimal('haber');
            $table->decimal('renta');
            $table->decimal('utilidad_neta');
            $table->decimal('utilidad');
            $table->integer('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodo')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('estado_resultado');
    }
}
