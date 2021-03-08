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
            $table->DateTime('Deadline');
            $table->string('Title');
            $table->text('Description');
            $table->DateTime('Finished')->nullable();
            $table->DateTime('ReminderDate')->nullable();
            $table->string('Creator');
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
