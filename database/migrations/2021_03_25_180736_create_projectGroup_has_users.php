<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectGroupHasUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('project_group_user', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('project_group_id');
      $table->primary(['user_id', 'project_group_id']);
//      $table->foreign('project_group_id')
//        ->references('id')
//        ->on('projectgroups')
//        ->onDelete('cascade');
//      $table->foreign('user_id')
//        ->references('id')
//        ->on('users')
//        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('project_group_user');
  }
}
