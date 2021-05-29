<?php

use App\Http\Requests\NoteRequest;
use App\Models\contact\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('migrate:fresh --seed');
    $this->rules = (new NoteRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test',
    ]);
    $this->be($user);
  }

  public function test_notes_create_screen_can_be_rendered()
  {
    $id = Contact::all()->first()->id;
    $this->assertAuthenticated();
    $response = $this->get('/notes/create/' . $id);
    $response->assertStatus(200);
  }

  public function test_notes_create_fails_no_description()
  {
    $id = Contact::all()->first()->id;
    $this->assertAuthenticated();
    $response = $this->post('/notes/insert/' . $id, [
      'description' => '',
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['description']);
  }
}
