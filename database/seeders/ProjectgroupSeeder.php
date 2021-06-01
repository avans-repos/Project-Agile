<?php

namespace Database\Seeders;

use App\Models\contact\Contact;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectgroupSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i = 0; $i < 50; $i++) {
      $projectId = Project::all()
        ->random(1)
        ->first()->id;
      $group = ProjectGroup::create([
        'name' => 'IN01 - Groep A' . $i,
        'project' => $projectId,
      ]);

      for ($i2 = 0; $i2 < random_int(0, 3); $i2++) {
        $userId = User::role('Student')
          ->get()
          ->random(1)
          ->first()->id;
        if (
          !$group
            ->users()
            ->where('user_id', $userId)
            ->exists()
        ) {
          $group->users()->attach($userId);
        }
      }
      $group->users()->attach(
        User::role('Teacher')
          ->get()
          ->random(1)
          ->first()->id
      );

      $group->contacts()->attach(
        Contact::all()
          ->random(1)
          ->first()->id
      );
    }
  }
}
