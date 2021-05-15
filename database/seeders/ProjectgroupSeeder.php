<?php

namespace Database\Seeders;

use App\Models\ProjectGroup;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectgroupSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $group = ProjectGroup::create([
      'name' => 'IN01 - Groep A1',
      'project' => 1,
    ]);

    $group->users()->sync([
      User::role('Student')->get()[0]->id,
      User::role('Student')->get()[1]->id,
      User::role('Student')->get()[2]->id,
      User::role('Teacher')->get()[0]->id,
    ]);


    $group2 = ProjectGroup::create([
      'name' => 'IN01 - Groep B2',
      'project' => 2,
    ]);

    $group2->users()->sync([
      User::role('Student')->get()[0]->id,
      User::role('Student')->get()[2]->id,
      User::role('Teacher')->get()[1]->id,
    ]);
  }
}
