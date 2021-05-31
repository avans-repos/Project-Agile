<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CompanyTest extends TestCase
{
  use RefreshDatabase;
  protected $seed = true;

  public function setUp(): void
  {
    parent::setUp();

    $this->validator = $this->app['validator'];

    DB::table('addresses')->insertOrIgnore([
      'id' => '1',
      'streetname' => 'Bermershof',
      'number' => '831',
      'zipcode' => '5403WP',
      'city' => 'Uden',
      'country' => 'The Netherlands',
    ]);

    DB::table('companies')->insertOrIgnore([
      'id' => '1',
      'name' => 'Vizova',
      'email' => 'martijn@vizova.nl',
      'phonenumber' => '0657305857',
      'size' => 1,
      'website' => 'https://vizova.nl',
      'visiting_address' => 1,
      'mailing_address' => 1,
    ]);

    $user = new User([
      'id' => 1,
      'name' => 'test',
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
    $response = $this->get(
      route('company.show', [
        'company' => 1,
      ])
    );

    $response->assertStatus(200);
  }
}
