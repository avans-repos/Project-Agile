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
        Schema::create('company_contacts', function (Blueprint $table) {
          $table->foreignId('contact_id')
            ->references('id')
            ->on('contacts')
            ->onDelete('cascade');

          $table->foreignId('company_id')
            ->constrained('companies');

          $table->string('contacttype');
          $table->foreign('contacttype')
            ->references('name')
            ->on('contact_types')
            ->onDelete('cascade');

          $table->dateTime('added');

          $table->primary(['contact_id', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_contacts');
    }
}
