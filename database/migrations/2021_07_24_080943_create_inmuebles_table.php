<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 200);
            $table->decimal('area_terreno', 8, 2);
            $table->decimal('area_construida', 8, 2);
            $table->decimal('area_libre', 8, 2);
            $table->integer('habitaciones')->nullable();//X
            $table->integer('baños')->nullable(); //X
            $table->integer('pisos')->nullable();
            $table->integer('garajes')->nullable();
            $table->integer('total_cupo')->nullable();
            $table->integer('cupo_ocupado')->nullable();


            //$table->string('image_url');


            $table->text('descripcion');
            $table->string('foto_principal')->nullable();
            $table->unsignedInteger('proyecto_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('zona_id');
            $table->unsignedInteger('tipoinmueble_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('zona_id')->references('id')->on('zonas');
            $table->foreign('tipoinmueble_id')->references('id')->on('tipo_inmuebles');
            $table->foreign('proyecto_id')->references('id')->on('inmuebles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inmuebles');
    }
}
