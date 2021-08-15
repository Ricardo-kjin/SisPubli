<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',60);
            $table->string('email',60);
            $table->string('telefono',15);
            $table->string('descripcion',300);
            $table->date('fechaconsulta');
            $table->unsignedInteger('publicacion_id');
            $table->timestamps();

            $table->foreign('publicacion_id')->references('id')->on('publicacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
