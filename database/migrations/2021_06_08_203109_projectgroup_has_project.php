<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectgroupHasProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectgroup_project', function (Blueprint $table) {
            $table->unsignedBigInteger('projectgroupid');
            $table->foreign('projectgroupid')->references('id')->on('project_groups');

            $table->unsignedBigInteger('projectid');
            $table->foreign('projectid')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectgroup_project');
    }
}
