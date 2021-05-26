<?php

namespace Tests\Feature;

use App\Events\NoteAdded;
use App\Http\Requests\NoteRequest;
use App\Models\contact\Contact;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NotificationTest extends TestCase
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
    $this->user = $user;
    $this->be($user);
  }

  public function test_notification_date_required_if_selected()
  {
    $id = Contact::all()->first()->id;
    $this->assertAuthenticated();
    $response = $this->post('/notes/insert/' . $id, [
      'description' => 'test',
      'reminder' => 1,
      'reminderdate' => '',
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['reminderdate']);
  }

  public function test_notification_wrong_date_format_error()
  {
    $id = Contact::all()->first()->id;
    $this->assertAuthenticated();
    $response = $this->post('/notes/insert/' . $id, [
      'description' => 'test',
      'reminder' => 1,
      'reminderdate' => 'asdf',
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['reminderdate']);
  }

  public function test_notification_date_is_today_fails()
  {
    $id = Contact::all()->first()->id;
    $this->assertAuthenticated();
    $response = $this->post('/notes/insert/' . $id, [
      'description' => 'test',
      'reminder' => 1,
      'reminderdate' => Carbon::now()->format('Y-m-d'),
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['reminderdate']);
  }
}
