<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
  public function run()
  {
    Note::factory()
      ->count(150)
      ->create(['contact' => 1]);
  }
}
