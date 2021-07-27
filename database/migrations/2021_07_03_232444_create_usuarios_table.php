<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuarios');
            $table->string('email',100);
            $table->string('contrasena',50);
            $table->json('telefono');
            $table->string('nombre',100);
            $table->date('fecha_nac');
            $table->boolean('estado');
            $table->timestamps();
            //$table->unsignedBigInteger('id_grupos');
            //$table->foreign('id_grupos')->references('id_grupos')->on('grupos')
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
        Schema::dropIfExists('usuarios');
    }
}
