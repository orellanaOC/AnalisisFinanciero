<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parametro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametro', function (Blueprint $table) {
            $table->id();
            $table->string('parametro');
            $table->double('min')->nullable();
            $table->double('max')->nullable();
            $table->double('valor')->nullable();
            $table->integer('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_parametro')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('parametro');
    }
}
