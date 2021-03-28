<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactpoint', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('contactPerson');
            $table->DateTime('dateOfContact');
            $table->text('description');

            $table->foreign('contactPerson')
              ->references('id')
              ->on('contacts')
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
        Schema::dropIfExists('contactpoint');
    }
}
