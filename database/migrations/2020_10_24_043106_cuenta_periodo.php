<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CuentaPeriodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_periodo', function (Blueprint $table) {
            $table->id();
            $table->decimal('total');
            $table->boolean('lado');
            $table->integer('cuenta_id');
            $table->foreign('cuenta_id')->references('id')->on('cuenta')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('cuenta_periodo');
    }
}
