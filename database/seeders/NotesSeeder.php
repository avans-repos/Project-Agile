<?php


namespace Database\Seeders;


use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeeder extends Seeder
{
  public function run()
  {
    $faker = Factory::create();
    DB::table('notes')->insert([
      'description' => $faker->text(300),
      'creator' => 1,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    DB::table('notes')->insert([
      'description' => $faker->text(200),
      'creator' => 2,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    DB::table('notes')->insert([
      'description' => $faker->text(250),
      'creator' => 3,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    DB::table('notes')->insert([
      'description' => $faker->text(30),
      'creator' => 4,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    DB::table('notes')->insert([
      'description' => $faker->text(1000),
      'creator' => 5,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
  }
}
