<?php

namespace Tests\Feature;

use App\Http\Requests\ProjectgroupRequest;
use App\Models\User;
use Database\Seeders\ProjectgroupSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\CreatesApplication;
use Tests\TestCase;

class ProjectgroupCreateTest extends TestCase
{
  use CreatesApplication, RefreshDatabase;


  public function setUp() : void
  {
    parent::setUp();
    $this->seed(RoleSeeder::class);
    $this->seed(UsersSeeder::class);
    $this->seed(ProjectgroupSeeder::class);
    $this->rules = (new ProjectgroupRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test'
    ]);

    $this->be($user);
  }

  /**
   * @return void
   */
  public function test_projectgroup_create_screen_can_be_rendered()
  {
    $this->assertAuthenticated();
    $response = $this->get('/projectgroup/create');
    $response->assertStatus(200);
  }

  /**
   * @return void
   */
  public function test_projectgroup_create_fails_no_name()
  {
    $response = $this
      ->post(route('projectgroup.store'), [
        'name' => ''
      ]);
    $response->assertSessionHasErrors([
      'name'
    ]);
  }


  /**
   * @return void
   */
  public function test_projectgroup_create_fails_name_too_long()
  {
    $response = $this
      ->post(route('projectgroup.store'), [
        'name' => Str::random(101)
      ]);
    $response->assertSessionHasErrors([
      'name'
    ]);
  }


  /**
   * @return void
   */
  public function test_projectgroup_create_success()
  {

    $name = Str::random(100);

    $response = $this
      ->post(route('projectgroup.store'), [
        'name' => $name
      ]);
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('projectgroups', [
      'name' => $name
    ]);
  }
}
