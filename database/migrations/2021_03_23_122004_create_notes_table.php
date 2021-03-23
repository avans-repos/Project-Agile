<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
          $table->id();

          $table->DateTime('creation');
          $table->text('description');

          $table->unsignedBigInteger('creator');
          $table->foreign('creator')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

          $table->unsignedBigInteger('contact');
          $table->foreign('contact')
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
        Schema::dropIfExists('notes');
    }
}
