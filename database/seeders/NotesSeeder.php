<?php


namespace Database\Seeders;


use App\Models\Note;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeeder extends Seeder
{
  public function run()
  {
    $faker = Factory::create();
    note::create([
      'description' => $faker->text(300),
      'creator' => 1,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    note::create([
      'description' => $faker->text(200),
      'creator' => 2,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    note::create([
      'description' => $faker->text(250),
      'creator' => 3,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    note::create([
      'description' => $faker->text(30),
      'creator' => 4,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
    note::create([
      'description' => $faker->text(1000),
      'creator' => 5,
      'contact' => 1,
      'creation' => $faker->dateTimeBetween('-1 day', 'now')
    ]);
  }
}
