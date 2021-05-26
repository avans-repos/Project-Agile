<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectgroupHasContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectgroup_has_contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('contactid');
            $table->unsignedBigInteger('projectgroupid');
            $table->primary(['contactid', 'projectgroupid']);
            $table->foreign('contactid')
              ->references('id')
              ->on('contacts')
              ->onDelete('cascade');
          $table->foreign('projectgroupid')
            ->references('id')
            ->on('projectgroups')
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
        Schema::dropIfExists('projectgroup_has_contacts');
    }
}
