<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('companies', function (Blueprint $table) {

      $table->id();
      $table->string('name', 50);
      $table->string('phonenumber', 15)->nullable();
      $table->string('email', 320)->nullable();
      $table->integer('size')->nullable();
      $table->string('website', 255)->nullable();
      $table->longText('note')->nullable();
      $table->unsignedBigInteger('visiting_address')->unsigned()->nullable();;
      $table->foreign('visiting_address')->references('id')->on('addresses');
      $table->unsignedBigInteger('mailing_address')->unsigned()->nullable();
      $table->foreign('mailing_address')->references('id')->on('addresses')->nullable();
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
    Schema::table('companies_deleted', function (Blueprint $table) {
      $table->dropSoftDeletes();
      $table->increments('id');
      $table->string('name', 50);
      $table->string('phonenumber', 15);
      $table->string('email', 320);
      $table->integer('size');
      $table->string('website', 255);
      $table->integer('visiting_address')->unsigned();
      $table->foreign('visiting_address')->references('id')->on('addresses');
      $table->integer('mailing_address')->unsigned()->nullable();
      $table->foreign('mailing_address')->references('id')->on('addresses')->nullable();
      $table->timestamps();
    });
  }
}
