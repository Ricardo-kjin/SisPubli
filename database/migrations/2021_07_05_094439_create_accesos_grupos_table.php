<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesosGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos_grupos', function (Blueprint $table) {
            $table->unsignedInteger('id_grupos');
            $table->unsignedInteger('id_accesos');

            $table->foreign('id_grupos')->references('id_grupos')->on('grupos')->onDelete('cascade');
            $table->foreign('id_accesos')->references('id_accesos')->on('accesos')->onDelete('cascade');

            $table->primary(['id_grupos','id_accesos']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesos_grupos');
    }
}
