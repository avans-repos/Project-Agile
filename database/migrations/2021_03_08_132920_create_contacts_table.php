<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->text('initials')->nullable();
            $table->text('firstname');
            $table->text('insertion')->nullable();
            $table->text('lastname');

            $table->string('gender',6)->nullable();
            $table->foreign('gender')->references('type')->on('genders');

            $table->text('email')->nullable();
            $table->text('phonenumber')->nullable();

            $table->string('type',20)->nullable();
            $table->foreign('type')->references('name')->on('contact_types');

            $table->unsignedBigInteger('address')->nullable();
            $table->foreign('address')
              ->references('id')
              ->on('addresses')
              ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
