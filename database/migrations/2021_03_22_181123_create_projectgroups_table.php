<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectgroupsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('projectgroups', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->bigInteger('project')->unsigned();
      $table->foreign('project')->references('id')->on('projects')->onDelete('cascade');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('projectgroups_deleted', function (Blueprint $table) {
      $table->dropSoftDeletes();
      $table->string('name', 100);
      $table->timestamps();
    });
  }
}
