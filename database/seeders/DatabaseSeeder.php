<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(RoleSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(GenderSeeder::class);
    $this->call(AddressSeeder::class);
    $this->call(CompanySeeder::class);
    $this->call(ProjectSeeder::class);
    $this->call(ContactTypeSeeder::class);
    $this->call(ContactSeeder::class);
    $this->call(NotesSeeder::class);
    $this->call(ProjectgroupSeeder::class);
    $this->call(ClassRoomSeeder::class);
    $this->call(StudentHasClassRoomSeeder::class);
    $this->call(EmailTagSeeder::class);
    $this->call(MailFormatSeeder::class);
    $this->call(ActionPointSeeder::class);
    $this->call(TeacherHasActionPointSeeder::class);
  }
}
