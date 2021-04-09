<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactHasContacttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_has_contacttypes', function (Blueprint $table) {
            $table->id();
          $table->unsignedBigInteger('contact');
          $table->foreign('contact')
            ->references('id')
            ->on('contacts')
            ->onDelete('cascade');

          $table->foreignId('company')->constrained('companies');

          $table->string('contacttype');
          $table->foreign('contacttype')
            ->references('name')
            ->on('contact_types')
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
        Schema::dropIfExists('contact_has_contacttypes');
    }
}
