<?php

namespace Database\Seeders;

use App\Models\Project;
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
    project::create([
      'name' => 'Interview met Vizova',
      'description' => 'Leg een interview af met Vizova en verwerk deze in een verslag.',
      'deadline' => new \DateTime('10/10/2021'),
      'notes' => 'De rubric staat op BlackBoard.',
    ]);

    project::create([
      'name' => 'Maak een plan van aanpak voor een bedrijf.',
      'description' => 'Plan van aanpak maken voor bedrijf X. Dit moet in tweetallen.',
      'deadline' => new \DateTime('10/10/2021'),
      'notes' => 'Tweetallen staan vast.',
    ]);
  }
}
