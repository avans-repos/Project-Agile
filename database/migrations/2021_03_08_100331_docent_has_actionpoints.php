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
        Schema::create('teacher_has_actionpoints', function (Blueprint $table) {
            $table->string('user');
            $table->unsignedBigInteger('actionpointid');
            $table->primary(['user', 'actionpointid']);
            $table->foreign('actionpointid')
              ->references('id')
              ->on('actionpoints')
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
        Schema::dropIfExists('DocentHasActionpoints');
    }
}
