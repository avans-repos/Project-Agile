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
    Note::factory()
      ->count(150)
      ->create(['contact' => 1]);
  }
}
