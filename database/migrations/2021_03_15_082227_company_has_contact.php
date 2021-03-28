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
            $table->foreignId('companyid')->constrained('companies');
            $table->foreignId('contactid')->constrained('contacts');
            $table->primary(['companyid', 'contactid']);
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
