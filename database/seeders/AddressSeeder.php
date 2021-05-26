<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Address::create([
      'streetname' => 'Bermershof',
      'number' => '831',
      'zipcode' => '5403WP',
      'city' => 'Uden',
      'country' => 'The Netherlands',
    ]);
    Address::create([
      'streetname' => 'Industrieweg',
      'number' => '55',
      'zipcode' => '5145PD',
      'city' => 'Waalwijk',
      'country' => 'The Netherlands',
    ]);
    Address::create([
      'streetname' => 'Backershagen',
      'number' => '99',
      'zipcode' => '1082GT',
      'city' => 'Amsterdam',
      'country' => 'The Netherlands',
    ]);
    Address::create([
      'streetname' => 'Kraaiendonk',
      'number' => '46',
      'zipcode' => '5428NZ',
      'city' => 'Venhorst',
      'country' => 'The Netherlands',
    ]);
    Address::create([
      'streetname' => 'Binderskampweg',
      'number' => '29',
      'zipcode' => '6545CA',
      'city' => 'Nijmegen',
      'country' => 'The Netherlands',
    ]);
    Address::create([
      'streetname' => 'Molentien',
      'number' => '10',
      'zipcode' => '5469EK',
      'city' => 'Erp',
      'country' => 'The Netherlands',
    ]);

    Address::factory()
      ->count(200)
      ->create();
  }
}
