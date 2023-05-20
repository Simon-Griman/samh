<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartamentoIdColumnToEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('departamento_id')->after('rolequipo_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
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
