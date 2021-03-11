<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocentHasActionpoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocentHasActionpoints', function (Blueprint $table) {
            $table->string('User');
            $table->unsignedBigInteger('ActionpointId');
            $table->primary(['User', 'ActionpointId']);
            $table->foreign('ActionpointId')->references('id')->on('actionpoints');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DocentHasActionpoints');
    }
}
