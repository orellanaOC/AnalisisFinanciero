<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculacionCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculacion_cuenta', function (Blueprint $table) {
            $table->integer('id_cuenta');
            $table->foreign('id_cuenta')->references('id')->on('cuenta')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_cuenta_sistema');
            $table->foreign('id_cuenta_sistema')->references('id')->on('cuenta_sistema')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresa')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['id_cuenta', 'id_cuenta_sistema', 'id_empresa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vinculacion_cuenta');
    }
}
