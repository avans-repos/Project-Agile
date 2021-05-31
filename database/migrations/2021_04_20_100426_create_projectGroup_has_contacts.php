<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectGroupHasContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_project_group', function (Blueprint $table) {
            $table->foreignId('contact_id')
              ->constrained()
              ->cascadeOnDelete();
            $table->foreignId('project_group_id')
              ->constrained()
              ->cascadeOnDelete();
            $table->primary(['contact_id', 'project_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_group_contact');
    }
}
