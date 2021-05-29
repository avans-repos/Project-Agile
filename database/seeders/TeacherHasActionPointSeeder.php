<?php

namespace Database\Seeders;

use App\Models\Actionpoint;
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
      $userId = User::role('Teacher')
        ->get()
        ->random(1)[0]->id;
      $actionpoint = Actionpoint::all()->random(1)[0];
      if (
        !$actionpoint
          ->teachers()
          ->where('user_id', $userId)
          ->exists()
      ) {
        $actionpoint->teachers()->attach($userId);
      }
    }
  }
}
