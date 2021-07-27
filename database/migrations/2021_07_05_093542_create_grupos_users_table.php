<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_users', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_grupos');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_grupos')->references('id_grupos')->on('grupos')->onDelete('cascade');

            $table->primary(['id_user','id_grupos']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_users');
    }
}
