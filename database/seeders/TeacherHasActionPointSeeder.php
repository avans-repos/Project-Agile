<?php

namespace Database\Seeders;

use App\Models\Actionpoint;
use App\Models\teacher_has_actionpoints;
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
      teacher_has_actionpoints::factory()
        ->count(10)
        ->create();
    }
}
