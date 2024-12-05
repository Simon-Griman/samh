<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNroControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nro_controls', function (Blueprint $table) {
            $table->id();
            $table->integer('entrada')->unique()->nullable();
            $table->integer('salida')->unique()->nullable();
            $table->integer('entrega')->unique()->nullable();
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
        Schema::dropIfExists('nro_controls');
    }
}
