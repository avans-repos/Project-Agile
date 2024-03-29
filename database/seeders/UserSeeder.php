<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    $tanja = new User([
      'name' => 'Admin',
      'email' => 'admin@avans.nl',
      'password' => bcrypt('admin@avans.nl'),
    ]);
    $tanja->assignRole('Admin');
    $tanja->save($tanja->toArray());

    $tanja = new User([
      'name' => 'Tanja Gielen',
      'email' => 't.gielen@avans.nl',
      'password' => bcrypt('t.gielen@avans.nl'),
    ]);
    $tanja->assignRole('Teacher');
    $tanja->save($tanja->toArray());

    $rene = new User([
      'name' => 'Rene Barnard',
      'email' => 'rp.barnard@avans.nl',
      'password' => bcrypt('rp.barnard@avans.nl'),
    ]);
    $rene->assignRole('Teacher');
    $rene->save($rene->toArray());

    $maikel = new User([
      'name' => 'Maikel Mocking',
      'email' => 'm.mocking1@avans.nl',
      'password' => bcrypt('m.mocking1@avans.nl'),
    ]);
    $maikel->assignRole('Teacher');
    $maikel->save($maikel->toArray());

    $tom = new User([
      'name' => 'Tom Cornelissen',
      'email' => 'tom@avans.nl',
      'password' => bcrypt('tom@avans.nl'),
    ]);
    $tom->assignRole('Student');
    $tom->save($tom->toArray());

    $job = new User([
      'name' => 'Job van Ooik',
      'email' => 'job@avans.nl',
      'password' => bcrypt('job@avans.nl'),
    ]);
    $job->assignRole('Student');
    $job->save($job->toArray());

    $martijn = new User([
      'name' => 'Martijn Ambagtsheer',
      'email' => 'martijn@avans.nl',
      'password' => bcrypt('martijn@avans.nl'),
    ]);
    $martijn->assignRole('Student');
    $martijn->save($martijn->toArray());

    $faker = Factory::create();
    for ($i = 0; $i < 50; $i++) {
      $email = $faker->email;
      $randomStudent = new User([
        'name' => $faker->name,
        'email' => $email,
        'password' => bcrypt($email),
      ]);
      $randomStudent->assignRole('Student');
      $randomStudent->save($randomStudent->toArray());
    }
  }
}
