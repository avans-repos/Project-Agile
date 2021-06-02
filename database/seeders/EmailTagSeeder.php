<?php

namespace Database\Seeders;

use App\Models\EmailTag;
use Illuminate\Database\Seeder;

class EmailTagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    EmailTag::create(['tag' => 'voornaam', 'description' => 'De voornaam van het contact.']);
    EmailTag::create(['tag' => 'achternaam', 'description' => 'De achternaam van het contact.']);
    EmailTag::create(['tag' => 'datum', 'description' => 'De huidige datum.']);
  }
}
