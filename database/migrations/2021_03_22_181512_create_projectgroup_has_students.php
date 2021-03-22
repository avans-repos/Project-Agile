<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectgroupHasStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectgroup_has_students', function (Blueprint $table) {
          $table->unsignedBigInteger('projectgroupid');
          $table->unsignedBigInteger('studentid');
          $table->primary(['projectgroupid', 'studentid']);
          $table->foreign('projectgroupid')
            ->references('id')
            ->on('projectgroups')
            ->onDelete('cascade');
          $table->foreign('studentid')
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
        Schema::dropIfExists('projectgroup_has_students');
    }
}
