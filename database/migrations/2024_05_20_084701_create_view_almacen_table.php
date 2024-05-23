<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewAlmacenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW view_almacen AS 
            SELECT nombre,
            tipo_unidad,
            (SUM(entrada) - SUM(salida)) AS total
            FROM almacens
            INNER JOIN articulos ON articulos.id = almacens.articulo_id
            GROUP BY articulo_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_almacen');
    }
}
