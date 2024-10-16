<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepreciacionColumnsToEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->date('fecha_adquisicion')->after('desincorporacion')->nullable();
            //$table->integer('depreciacion')->after('fecha_adquisicion')->nullable();
            //$table->integer('depreciacion_acumulada')->after('depreciacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos', function (Blueprint $table) {
            //
        });
    }
}
