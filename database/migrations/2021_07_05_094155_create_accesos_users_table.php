<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos_users', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_accesos');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_accesos')->references('id_accesos')->on('accesos')->onDelete('cascade');

            $table->primary(['id_user','id_accesos']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesos_users');
    }
}
