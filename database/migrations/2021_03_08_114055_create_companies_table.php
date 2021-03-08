<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('phonenumber',15);
            $table->string('email',320);
            $table->integer('size');
            $table->string('website',255);
            $table->integer('visiting_address')->unsigned();
            $table->foreign('visiting_address')->references('id')->on('addresses');
            $table->integer('mailing_address')->unsigned()->nullable();
            $table->foreign('mailing_address')->references('id')->on('addresses')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
