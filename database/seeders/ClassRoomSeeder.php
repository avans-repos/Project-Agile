<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOa',
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOb',
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOc',
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOd',
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BIa',
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BIb',
    ]);    DB::table('class_rooms')->insert([
    'name' => '42IN4BIc',
  ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BId',
    ]);
  }
}
