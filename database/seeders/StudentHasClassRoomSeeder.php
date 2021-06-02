<?php

namespace Database\Seeders;

use App\Models\student_has_class_room;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentHasClassRoomSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::role('Student')
      ->first()
      ->classrooms()
      ->sync(1);

    User::role('Student')
      ->get()[1]
      ->classrooms()
      ->sync(1);
  }
}
