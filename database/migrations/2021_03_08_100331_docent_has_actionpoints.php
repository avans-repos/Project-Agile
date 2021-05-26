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
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('actionpointid');
            $table->primary(['userid', 'actionpointid']);
            $table->foreign('actionpointid')
              ->references('id')
              ->on('actionpoints')
              ->onDelete('cascade');
            $table->foreign('userid')
              ->references('id')
              ->on('users')
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
