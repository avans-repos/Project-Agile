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

    DB::table('contacts')->insert([
      'initials' => 'TAGW',
      'firstname' => 'Tom',
      'lastname' => 'Cornelissen',
      'gender' => 'man',
      'email' => 'tagwcorn@avans.nl',
      'phonenumber' => '0647181543',
      'type' => 'warm',
    ]);

    DB::table('contacts')->insert([
      'initials' => 'J',
      'firstname' => 'Job',
      'insertion' => 'van',
      'lastname' => 'Ooik',
      'gender' => 'man',
      'email' => 'job@avans.nl',
      'phonenumber' => '0653246443',
      'type' => 'warm',
    ]);

    DB::table('contacts')->insert([
      'initials' => 'J',
      'firstname' => 'Jaap',
      'lastname' => 'Rodenburg',
      'gender' => 'man',
      'email' => 'jaap@avans.nl',
      'phonenumber' => '0654344443',
      'type' => 'warm',
    ]);

    DB::table('contacts')->insert([
      'initials' => 'M',
      'firstname' => 'Marijn',
      'lastname' => 'Kieboom',
      'gender' => 'man',
      'email' => 'marijn@avans.nl',
      'phonenumber' => '0652434442',
      'type' => 'warm',
    ]);

    DB::table('contacts')->insert([
      'initials' => 'J',
      'firstname' => 'Jeroen',
      'lastname' => 'Vermaat',
      'gender' => 'man',
      'email' => 'jeroen@avans.nl',
      'phonenumber' => '0624333441',
      'type' => 'warm',
    ]);
  }
}
