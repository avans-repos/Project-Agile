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
  // These cascade on delete constraints don't actually do anything because soft deletes are enabled on project groups
  public function up()
  {
    Schema::create('project_group_user', function (Blueprint $table) {
      $table->foreignId('user_id')
        ->constrained()
        ->onDelete('cascade');
      $table->foreignId('project_group_id')
        ->constrained()
        ->onDelete('cascade');
      $table->primary(['user_id', 'project_group_id']);
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
