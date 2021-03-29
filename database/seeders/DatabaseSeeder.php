<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
    $this->call(AddressSeeder::class);
    $this->call(GenderSeeder::class);
    $this->call(ContactTypeSeeder::class);
    $this->call(ContactSeeder::class);
    $this->call(CompanySeeder::class);
    $this->call(CompanyHasContactsSeeder::class);
    $this->call(ProjectgroupSeeder::class);
  }
}
