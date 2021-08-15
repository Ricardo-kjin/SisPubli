<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->decimal('precio',10,2);
            $table->string('periodo',50)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('inmueble_id');
            $table->unsignedInteger('tipopublicacion_id');
            $table->unsignedInteger('nota_venta_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('nota_venta_id')->references('id_nota_ventas')->on('nota_ventas');
            $table->foreign('tipopublicacion_id')->references('id')->on('tipopublicacions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicacions');
    }
}
