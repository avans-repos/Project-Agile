<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentHasClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_has_class_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('student');
            $table->unsignedBigInteger('class_room');

          $table->foreign('student')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

          $table->foreign('class_room')
            ->references('id')
            ->on('class_rooms')
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
        Schema::dropIfExists('student_has_class_rooms');
    }
}
