<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyHasContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_has_contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('companyid');
            $table->unsignedBigInteger('contactid');
            $table->primary(['companyid', 'contactid']);
            $table->foreign('contactid')
              ->references('id')
              ->on('contacts')
              ->onDelete('cascade');
            /*$table->foreign('companyid')
              ->references('id')
              ->on('companies')
              ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_has_contacts');
    }
}
