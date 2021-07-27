<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilegios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_grupos');
            $table->unsignedBigInteger('id_accesos');
            $table->boolean('estado');

            $table->foreign('id_grupos')->references('id_grupos')->on('grupos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_accesos')->references('id_accesos')->on('accesos')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('privilegios');
    }
}
