<?php

namespace Database\Seeders;

use App\Models\contact\Contact;
use App\Models\Project;
use App\Models\Projectgroup;
use App\Models\projectgroup_has_contacts;
use App\Models\projectgroup_has_users;
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
    for ($i = 0; $i < 50; $i++) {
      $projectGroup = projectgroup::create([
        'name' => 'IN01 - Groep A' . $i,
        'project' => Project::all()->random(1)[0]->id,
      ]);

      for ($i2 = 0; $i2 < random_int(0, 3); $i2++) {
        projectgroup_has_users::firstOrCreate([
          'userid' => User::role('Student')
            ->get()
            ->random(1)[0]->id,
          'projectgroupid' => $projectGroup->id,
        ]);
      }
      projectgroup_has_users::firstOrCreate([
        'userid' => User::role('Teacher')
          ->get()
          ->random(1)[0]->id,
        'projectgroupid' => $projectGroup->id,
      ]);
      projectgroup_has_contacts::firstOrCreate([
        'contactid' => Contact::all()->random(1)[0]->id,
        'projectgroupid' => $projectGroup->id,
      ]);
    }
  }
}
