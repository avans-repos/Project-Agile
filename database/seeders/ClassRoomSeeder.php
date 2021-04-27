<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
      'year' => Carbon::now()->format('Y')
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOb',
      'year' => Carbon::now()->format('Y')
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOc',
      'year' => Carbon::now()->format('Y')
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOd',
      'year' => Carbon::now()->format('Y')
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BIa',
      'year' => Carbon::now()->format('Y')
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BIb',
      'year' => Carbon::now()->format('Y')
    ]);    DB::table('class_rooms')->insert([
    'name' => '42IN4BIc',
    'year' => Carbon::now()->format('Y')
  ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BId',
      'year' => Carbon::now()->format('Y')
    ]);
  }
}
