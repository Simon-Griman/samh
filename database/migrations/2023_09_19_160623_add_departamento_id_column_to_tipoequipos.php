<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartamentoIdColumnToTipoequipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipoequipos', function (Blueprint $table) {
            $table->unsignedBigInteger('departamento_id')->after('nombre');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipoequipos', function (Blueprint $table) {
            //
        });
    }
}
