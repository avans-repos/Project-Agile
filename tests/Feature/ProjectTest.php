<?php

namespace Tests\Feature;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\CreatesApplication;
use Tests\TestCase;

class ProjectTest extends TestCase
{
  use CreatesApplication, RefreshDatabase;

  protected $seed = true;

  public function setUp() : void
  {
    parent::setUp();
    $this->rules = (new ProjectRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test'
    ]);

    $this->be($user);
  }

    public function test_project_screen_can_be_rendered()
    {
        $response = $this->get('/project');

        $response->assertStatus(200);
    }


  public function test_can_add_new_project_succes()
  {

    $name = 'Test Project';
    $description = 'This is a test';
    $deadline = new \DateTime('10/10/2032');
    $notes = 'This is a test';

    $response = $this
      ->post(route('project.store'), [
        'name' => $name,
        'description' => $description,
        'deadline'  => $deadline,
        'notes' => $notes
      ]);
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('projects', [
      'name' => $name,
      'description' => $description,
      'deadline'  => $deadline,
      'notes' => $notes
    ]);
  }

  public function test_can_add_new_project_fails_input_too_large()
  {

    $name = Str::random(46);
    $description = Str::random(256);
    $deadline = new \DateTime('10/10/2032');
    $notes = 'This is a test';

    $response = $this
      ->post(route('project.store'), [
        'name' => $name,
        'description' => $description,
        'deadline'  => $deadline,
        'notes' => $notes
      ]);
    $response->assertSessionHasErrors();

  }

  public function test_can_add_new_project_fails_no_input()
  {

    $name = '';
    $description = '';
    $deadline = '';
    $notes = '';

    $response = $this
      ->post(route('project.store'), [
        'name' => $name,
        'description' => $description,
        'deadline'  => $deadline,
        'notes' => $notes
      ]);
    $response->assertSessionHasErrors();

  }
}
