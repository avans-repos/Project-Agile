<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actionpoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actionpoints', function (Blueprint $table) {
            $table->id();
            $table->DateTime('deadline');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('finished')->nullable();
            $table->DateTime('reminderdate')->nullable();
            $table->unsignedBigInteger('creator');
            $table->foreign('creator')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Actionpoints');
    }
}
