<?php

namespace Database\Seeders;

use App\Models\Actionpoint;
use App\Models\teacher_has_actionpoints;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherHasActionPointSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i = 0; $i < 50; $i++) {
      teacher_has_actionpoints::firstOrCreate([
        'userid' => User::role('Teacher')
          ->get()
          ->random(1)[0]->id,
        'actionpointid' => Actionpoint::all()->random(1)[0]->id,
      ]);
    }
  }
}
