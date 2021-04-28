<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('projects')->insert([
      'name' => 'Project 1',
      'description' => 'test project',
      'deadline' => new \DateTime('10/10/2021'),
      'notes' => 'test notes',
    ]);
  }
}
