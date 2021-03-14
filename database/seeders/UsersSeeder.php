<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
  public function run(){
    DB::table('users')->insert([
    'name' => 'Jaap Rodenburg',
      'email' => 'jaap@avans.nl',
      'password' => bcrypt('jaap@avans.nl')
    ]);
    DB::table('users')->insert([
        'name' => 'Jeroen Vermaat',
        'email' => 'jeroen@avans.nl',
        'password' => bcrypt('jeroen@avans.nl')
      ]);
    DB::table('users')->insert([
        'name' => 'Marijn Kieboom',
        'email' => 'marijn@avans.nl',
        'password' => bcrypt('marijn@avans.nl')
      ]);
    DB::table('users')->insert([
        'name' => 'Marijn Kieboom',
        'email' => 'marijn@avans.nl',
        'password' => bcrypt('marijn@avans.nl')
      ]);
    DB::table('users')->insert([
      'name' => 'Tom Cornelissen',
      'email' => 'tom@avans.nl',
      'password' => bcrypt('tom@avans.nl')
    ]);
    DB::table('users')->insert([
      'name' => 'Job van Ooik',
      'email' => 'job@avans.nl',
      'password' => bcrypt('job@avans.nl')
    ]);
    DB::table('users')->insert([
      'name' => 'Martijn Abagtsheer',
      'email' => 'martijn@avans.nl',
      'password' => bcrypt('martijn@avans.nl')
    ]);
  }
}
