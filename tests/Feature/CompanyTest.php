<?php

namespace Tests\Feature;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\User;
use Database\Seeders\ProjectgroupSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\CreatesApplication;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    public function setUp() : void
    {
        parent::setUp();
        DB::table('addresses')->insertOrIgnore([
            'id' => '1',
            'streetname' => 'Bermershof',
            'number' => '831',
            'zipcode' => '5403WP',
            'city' => 'Uden',
            'country' => 'The Netherlands'
        ]);

        DB::table('companies')->insertOrIgnore([
            'id' => '1',
            'name' => 'Vizova',
            'email' => 'martijn@vizova.nl',
            'phonenumber' => '0657305857',
            'size' => 1,
            'website' => 'https://vizova.nl',
            'visiting_address' => 1,
            'mailing_address' => 1
        ]);

        $user = new User([
        'id' => 1,
        'name' => 'test'
        ]);

        $this->be($user);
    }

    public function test_company_overview_screen_can_be_rendered()
    {
        $this->assertAuthenticated();
        $response = $this->get('/company');

        $response->assertStatus(200);
    }

    public function test_company_details_screen_can_be_rendered()
    {
        $this->assertAuthenticated();
        $response = $this->get('/company/1');

        $response->assertStatus(200);
    }
}
