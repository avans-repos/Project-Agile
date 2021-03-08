<?php

namespace Database\Seeders;

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
        DB::table('companies')->insert([
            'name' => 'Vizova',
            'email' => 'martijn@vizova.n;',
            'phonenumber' => '0657305857',
            'size' => 1,
            'website' => 'https://vizova.nl',
            'visiting_address' => 1,
        ]);
    }
}
