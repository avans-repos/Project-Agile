<?php

namespace Database\Seeders;

use App\Models\student_has_class_room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentHasClassRoomSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    student_has_class_room::create([
      'student' => User::role('Student')
        ->get()
        ->first()->id,
      'class_room' => 1,
    ]);
    student_has_class_room::create([
      'student' => User::role('Student')->get()[1]->id,
      'class_room' => 1,
    ]);
  }
}
