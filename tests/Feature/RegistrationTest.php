<?php

namespace Tests\Feature;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
  use RefreshDatabase;

  public function setUp() : void
  {
    parent::setUp();
    $this->artisan('migrate:fresh --seed');
  }

  public function test_registration_screen_can_be_rendered()
  {
    $response = $this->get('/register');

    $response->assertStatus(200);
  }

  public function test_new_users_can_register()
  {
    $user = new User([
      'id' => 1,
      'name' => 'test'
    ]);

    $this->be($user);

    $response = $this->post('/register', [
      'name' => 'Test User',
      'email' => 'test@example.com',
      'password' => 'password',
      'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
  }
}
