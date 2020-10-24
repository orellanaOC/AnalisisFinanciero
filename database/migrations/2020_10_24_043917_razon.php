<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Razon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razon', function (Blueprint $table) {
            $table->id();
            $table->decimal('double');
            $table->integer('parametro_id');
            $table->foreign('parametro_id')->references('id')->on('parametro')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('razon');
    }
}
