<?php

namespace Database\Seeders;

use App\Models\Actionpoint;
use Illuminate\Database\Seeder;

class ActionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Actionpoint::factory()
        ->count(20)
        ->create();
    }
}
