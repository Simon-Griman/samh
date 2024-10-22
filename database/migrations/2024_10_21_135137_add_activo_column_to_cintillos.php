<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivoColumnToCintillos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cintillos', function (Blueprint $table) {
            $table->string('title', 45)->after('nombre')->nullable();
            $table->enum('activo', [1, 2])->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cintillos', function (Blueprint $table) {
            //
        });
    }
}
