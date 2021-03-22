<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectgroupHasStudentsSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('projectgroup_has_students')->insert([
        'projectgroupid' => '1',
        'studentid' => '1'
      ]);
    }
}
