<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_facturas');
            $table->date('fecha_emicion');
            $table->integer('impuesto_iva');
            $table->double('costo_bruto');
            $table->double('costo_neto');
            $table->boolean('estado');
            $table->timestamps();
            $table->unsignedBigInteger('id_tipo_pagos');
            $table->foreign('id_tipo_pagos')->references('id_tipo_pagos')->on('tipo_pagos')
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
        Schema::dropIfExists('facturas');
    }
}
