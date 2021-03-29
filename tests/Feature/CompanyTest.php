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
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\CreatesApplication;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /*
    use RefreshDatabase;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
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
    */
}
