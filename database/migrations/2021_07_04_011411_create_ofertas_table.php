<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id('id_ofertas');
            $table->string('nombre',100);
            $table->string('duracion',20);
            $table->decimal('costo',6,2);
            $table->text('descripcion');
            $table->boolean('estado');
            $table->timestamps();
            $table->unsignedBigInteger('id_planes');
            $table->foreign('id_planes')->references('id_planes')->on('planes')
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
        Schema::dropIfExists('ofertas');
    }
}
