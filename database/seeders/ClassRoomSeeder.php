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
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '4'
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOb',
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '4'
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOc',
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '4'
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4SOd',
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '4'
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN4BIa',
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '4'
    ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN5BIb',
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '5'
    ]);
    DB::table('class_rooms')->insert([
    'name' => '42IN5BIc',
    'year' => Carbon::now()->format('Y'),
    'schoolBlock' => '5'
  ]);
    DB::table('class_rooms')->insert([
      'name' => '42IN5BId',
      'year' => Carbon::now()->format('Y'),
      'schoolBlock' => '5'
    ]);
  }
}
