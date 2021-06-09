<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Symfony\Component\HttpFoundation\Request;
use Tests\CreatesApplication;
use Tests\TestCase;


class AdminTest extends TestCase
{
  /**
   * @var User
   */
  private $user;

  use CreatesApplication;
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('migrate:fresh --seed');
    $this->validator = $this->app['validator'];
    $this->app->make(PermissionRegistrar::class)->registerPermissions();
    $this->be(User::role('Admin')->first());
  }

  /**
   * Test if the screen to edit a user is vissable for the employee
   *
   * @return void
   */
  public function test_edit_screen_can_be_rendered()
  {
    $this->assertAuthenticated();
    $user = User::role('Admin')->first();
    $response = $this->get(route('user.edit', ['user' => $user]));

    $response->assertStatus(200);
  }

  /**
   * Test if the screen to edit a user is blocked if it has no errors
   *
   * @return void
   */
  public function test_edit_screen_blocked_for_no_admin_users()
  {
    $this->be(User::role('Student')->first());
    $this->assertAuthenticated();
    $user = User::role('Student')->first();
    $response = $this->get(route('user.edit', ['user' => $user]));

    $response->assertStatus(302);
  }

  public function test_at_least_one_admin_in_database()
  {
    $this->assertAuthenticated();
    $user = User::role('Admin')->first();
    $response = $this->patch(route('user.update', ['user' => $user]), [
      'roles' => [1],
    ]);
    $response->assertSessionHasErrors();
  }
}
