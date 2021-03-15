<?php

namespace Database\Seeders;

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
        DB::table('addresses')->insert([
            'streetname' => 'Bermershof',
            'number' => '831',
            'zipcode' => '5403WP',
            'city' => 'Uden',
            'country' => 'The Netherlands'
        ]);
    }
}
