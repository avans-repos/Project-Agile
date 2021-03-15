<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('streetname',100);
            $table->integer('number');
            $table->string('addition',5)->nullable();
            $table->string('zipcode',10);
            $table->string('city',100);
            $table->string('country',50);
            $table->timestamps();
            $table->unique(array('zipcode', 'number','city'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
