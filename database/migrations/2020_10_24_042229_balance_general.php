<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BalanceGeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_general', function (Blueprint $table) {
            $table->id();
            $table->decimal('activos');
            $table->decimal('pasivos');
            $table->decimal('patrimonio');
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
        Schema::dropIfExists('balance_general');
    }
}
