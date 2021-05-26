<?php

namespace Database\Seeders;

use App\Models\Address;
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
    address::create([
      'streetname' => 'Bermershof',
      'number' => '831',
      'zipcode' => '5403WP',
      'city' => 'Uden',
      'country' => 'The Netherlands',
    ]);
    address::create([
      'streetname' => 'Industrieweg',
      'number' => '55',
      'zipcode' => '5145PD',
      'city' => 'Waalwijk',
      'country' => 'The Netherlands',
    ]);
    address::create([
      'streetname' => 'Backershagen',
      'number' => '99',
      'zipcode' => '1082GT',
      'city' => 'Amsterdam',
      'country' => 'The Netherlands',
    ]);
    address::create([
      'streetname' => 'Kraaiendonk',
      'number' => '46',
      'zipcode' => '5428NZ',
      'city' => 'Venhorst',
      'country' => 'The Netherlands',
    ]);
    address::create([
      'streetname' => 'Binderskampweg',
      'number' => '29',
      'zipcode' => '6545CA',
      'city' => 'Nijmegen',
      'country' => 'The Netherlands',
    ]);
    address::create([
      'streetname' => 'Molentien',
      'number' => '10',
      'zipcode' => '5469EK',
      'city' => 'Erp',
      'country' => 'The Netherlands',
    ]);
  }
}
