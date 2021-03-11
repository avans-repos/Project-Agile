<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('contacts')->insert([
      'initials' => 'MBM',
      'firstname' => 'Martijn',
      'lastname' => 'Ambagtsheer',
      'gender' => 'man',
      'email' => 'ambagtsheer.m@gmail.com',
      'phonenumber' => '0657305857',
      'type' => 'warm',
    ]);
  }
}
