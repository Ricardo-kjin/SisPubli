<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_ventas', function (Blueprint $table) {
            $table->id('id_nota_ventas');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->boolean('estado');

            $table->unsignedBigInteger('id_usuarios');
            $table->unsignedBigInteger('id_ofertas');
            $table->unsignedBigInteger('id_facturas');

            $table->timestamps();

            $table->foreign('id_usuarios')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_ofertas')->references('id_ofertas')->on('ofertas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_facturas')->references('id_facturas')->on('facturas')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_ventas');
    }
}
