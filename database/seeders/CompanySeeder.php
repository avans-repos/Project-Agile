<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    company::create([
      'name' => 'Vizova',
      'email' => 'martijn@vizova.nl',
      'phonenumber' => '0657305857',
      'size' => 1,
      'website' => 'https://vizova.nl',
      'visiting_address' => 1,
      'mailing_address' => 1,
    ]);
    company::create([
      'name' => '\'t Arendje Verhuur en Dranken B.V.',
      'email' => 'info@arendje.nl',
      'phonenumber' => '0416373000',
      'size' => 15,
      'website' => 'https://www.arendje.nl',
      'visiting_address' => 2,
      'mailing_address' => 2,
    ]);
    company::create([
      'name' => '1Camera',
      'phonenumber' => '0204166407',
      'email' => 'info@1camera.nl',
      'size' => 42,
      'website' => 'http://www.1camera.nl/',
      'visiting_address' => 3,
      'mailing_address' => 3,
    ]);
    company::create([
      'name' => 'AFL Groep B.V.',
      'phonenumber' => '0852734998',
      'email' => 'info@aalgroep.nl',
      'size' => 12,
      'website' => 'http://aalgroep.nl',
      'visiting_address' => 4,
      'mailing_address' => 4,
    ]);
    company::create([
      'name' => 'Aveza Industrial Automation',
      'phonenumber' => '0243660100',
      'email' => 'info@aveza.nl',
      'size' => 419,
      'website' => 'http://aveza.nl',
      'visiting_address' => 5,
      'mailing_address' => 5,
    ]);
    company::create([
      'name' => 'Batterij Import Nederland BV',
      'email' => 'info@batterijimportnederland.nl',
      'size' => 1301,
      'visiting_address' => 6,
      'mailing_address' => 6,
    ]);

    Company::factory()
      ->count(200)
      ->create();
  }
}
