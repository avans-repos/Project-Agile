<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
  public function run()
  {
    $jaap = new User([
      'name' => 'Jaap Rodenburg',
      'email' => 'jaap@avans.nl',
      'password' => bcrypt('jaap@avans.nl'),
    ]);
    $jaap->assignRole('teacher');
    $jaap->save($jaap->toArray());

    $jeroen = new User([
      'name' => 'Jeroen vermaat',
      'email' => 'jeroen@avans.nl',
      'password' => bcrypt('jeroen@avans.nl'),
    ]);
    $jeroen->assignRole('teacher');
    $jeroen->save($jeroen->toArray());

    $marijn = new User([
      'name' => 'marijn Kieboom',
      'email' => 'marijn@avans.nl',
      'password' => bcrypt('marijn@avans.nl'),
    ]);
    $marijn->assignRole('teacher');
    $marijn->save($marijn->toArray());


    $tom = new User([
      'name' => 'Tom Cornelissen',
      'email' => 'tom@avans.nl',
      'password' => bcrypt('tom@avans.nl'),
    ]);
    $tom->assignRole('student');
    $tom->save($tom->toArray());

    $job = new User([
      'name' => 'Job van Ooik',
      'email' => 'job@avans.nl',
      'password' => bcrypt('job@avans.nl'),
    ]);
    $job->assignRole('student');
    $job->save($job->toArray());


    $martijn = new User([
      'name' => 'Martijn Ambagtsheer',
      'email' => 'martijn@avans.nl',
      'password' => bcrypt('martijn@avans.nl'),
    ]);
    $martijn->assignRole('student');
    $martijn->save($martijn->toArray());
  }
}
