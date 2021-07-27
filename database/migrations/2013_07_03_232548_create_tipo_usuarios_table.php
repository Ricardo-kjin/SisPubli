<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profesion',100);
            $table->string('nit_agente',20);
            $table->string('nombre_empresa',100);
            $table->string('direccion_empresa',200);
            $table->string('registro_empresa',20);
            $table->string('telefono_empresa',20);
            $table->string('nit_empresa',20);
            $table->boolean('estado');
            $table->timestamps();
            //$table->unsignedBigInteger('id_usuarios');
            //$table->foreign('id_usuarios')->references('id_usuarios')->on('usuarios')
            //->onDelete('cascade')->onUpdate('cascade');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_usuarios');
    }
}
