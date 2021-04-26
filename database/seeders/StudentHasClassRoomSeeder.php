<?php

namespace Database\Seeders;

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
    DB::table('student_has_class_rooms')->insert([
      'student' => User::role('student')->get()->first()->id,
      'class_room' => 1
    ]);
    DB::table('student_has_class_rooms')->insert([
      'student' => User::role('student')->get()[1]->id,
      'class_room' => 1
    ]);
  }
}
