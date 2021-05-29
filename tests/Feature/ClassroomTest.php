<?php

namespace Tests\Feature;
use App\Http\Requests\ClassRoomRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ClassroomTest extends TestCase
{
  use CreatesApplication;
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('migrate:fresh --seed');
    $this->rules = (new ClassRoomRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test',
    ]);

    $this->be($user);
  }

  public function test_classroom_screen_can_be_rendered()
  {
    $this->assertAuthenticated();
    $response = $this->get(route('classroom.index'));
    $response->assertStatus(200);
  }

  public function test_create_classroom_fails_year_before_1900()
  {
    $response = $this->post(route('classroom.store'), [
      'year' => 1800,
    ]);
    $response->assertSessionHasErrors(['year']);
  }

  public function test_create_classroom_fails_no_class_name()
  {
    $response = $this->post(route('classroom.store'), [
      'name' => '',
    ]);
    $response->assertSessionHasErrors(['name']);
  }

  public function test_create_classroom_success()
  {
    $student = User::role('Student')
      ->get()
      ->first()->id;
    $response = $this->post(route('classroom.store'), [
      'name' => 'TestKlas',
      'year' => Carbon::now()->year,
      'student' => [$student],
    ]);

    $response->assertSessionDoesntHaveErrors();

    $this->assertDatabaseHas('class_rooms', [
      'name' => 'TestKlas',
      'year' => Carbon::now()->year,
    ]);
  }
}
