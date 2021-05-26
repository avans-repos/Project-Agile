<?php

namespace Database\Seeders;

use App\Models\contact\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Contact::factory()
      ->count(150)
      ->create();
  }
}
