<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actionpoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Actionpoints', function (Blueprint $table) {
            $table->id();
            $table->timestamp('Deadline');
            $table->string('Titel');
            $table->text('Description');
            $table->timestamp('Finished');
            $table->timestamp('ReminderDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Actionpoints');
    }
}
