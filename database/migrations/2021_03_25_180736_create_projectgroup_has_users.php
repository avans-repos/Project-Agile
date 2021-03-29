<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectgroupHasUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('projectgroup_has_users', function (Blueprint $table) {
      $table->unsignedBigInteger('userid');
      $table->unsignedBigInteger('projectgroupid');
      $table->primary(['userid', 'projectgroupid']);
      $table->foreign('projectgroupid')
        ->references('id')
        ->on('projectgroups')
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
    Schema::dropIfExists('projectgroup_has_users');
  }
}
