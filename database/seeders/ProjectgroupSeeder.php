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
    ProjectGroup::create([
      'name' => 'IN01 - Groep A1',
      'project' => 1,
    ]);

    ProjectGroup::create([
      'name' => 'IN01 - Groep B2',
      'project' => 2,
    ]);

    DB::table('projectgroup_has_users')->insert([
      'userid' => User::role('Student')
        ->get()
        ->first()->id,
      'projectgroupid' => 1,
    ]);

    DB::table('projectgroup_has_users')->insert([
      'userid' => User::role('Student')->get()[1]->id,
      'projectgroupid' => 1,
    ]);

    DB::table('projectgroup_has_users')->insert([
      'userid' => User::role('Student')->get()[2]->id,
      'projectgroupid' => 1,
    ]);

    DB::table('projectgroup_has_users')->insert([
      'userid' => User::role('Student')->get()[2]->id,
      'projectgroupid' => 2,
    ]);

    DB::table('projectgroup_has_users')->insert([
      'userid' => User::role('Student')->get()[0]->id,
      'projectgroupid' => 2,
    ]);
  }
}
