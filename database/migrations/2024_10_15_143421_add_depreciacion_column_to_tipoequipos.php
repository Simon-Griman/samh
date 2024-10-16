<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepreciacionColumnToTipoequipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipoequipos', function (Blueprint $table) {
            $table->integer('depreciacion')->nullable()->after('departamento_id');
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
