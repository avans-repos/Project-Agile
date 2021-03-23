<?php


use App\Http\Requests\NoteRequest;
use App\Models\contact\Contact;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NoteTest extends TestCase
{
  use RefreshDatabase;

  public function setUp() : void
  {
    parent::setUp();
    $this->rules     = (new NoteRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test'
    ]);
    DB::table('genders')->insert([
      'type' => 'man',
    ]);
    DB::table('contact_types')->insert([
      'name' => 'warm',
    ]);
    DB::table('contacts')->insert([
      'initials' => 'MBM',
      'firstname' => 'Martijn',
      'lastname' => 'Ambagtsheer',
      'gender' => 'man',
      'email' => 'ambagtsheer.m@gmail.com',
      'phonenumber' => '0657305857',
      'type' => 'warm'
    ]);
    $this->be($user);
  }

  public function test_notes_create_screen_can_be_rendered()
  {
    $this->assertAuthenticated();
    $response = $this->get('/notes/create/1');
    $response->assertStatus(200);
  }

  public function test_notes_create_fails_no_description()
  {
    $this->assertAuthenticated();
    $response = $this
      ->post('/notes/insert/1', [
        'description' => ''
      ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors([
      'description'
    ]);
  }
}
