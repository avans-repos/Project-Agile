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

            $table->string('initials',10);
            $table->string('firstname',50);
            $table->string('insertion',10)->nullable();
            $table->string('lastname',50);

            $table->string('gender',6);
            $table->foreign('gender')->references('type')->on('genders');

            $table->string('email',320)->nullable();
            $table->string('phonenumber',15)->nullable();

            $table->string('type',20)->nullable();
            $table->foreign('type')->references('name')->on('contact_types');
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
