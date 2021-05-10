<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
  }
}
