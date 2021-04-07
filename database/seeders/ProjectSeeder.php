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
        'name' => 'project 1',
        'description' => 'beschijrving van project 1',
        'deadline' => '2022-01-01 18:00'
      ]);
    }
}
