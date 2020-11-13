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
            $table->double('ventas_netas');
            $table->double('utilidad_bruta');
            $table->double('utilidad_operativa');
            $table->double('utilidad_antes_de_i');
            $table->double('impuestos');
            $table->double('utilidad_neta');
            $table->double('ventas');
            $table->double('devolucion_ventas');
            $table->double('descuento_ventas');
            $table->double('costo_ventas');
            $table->double('gastos_operacion');
            $table->double('otros_ingresos');
            $table->double('otros_gastos');
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
