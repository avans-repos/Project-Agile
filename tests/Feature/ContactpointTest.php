<?php

namespace Tests\Feature;
use App\Http\Requests\ContactpointRequest;
use App\Models\Contactpoint;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\CreatesApplication;
use Tests\TestCase;

class ContactpointTest extends TestCase
{
  use CreatesApplication,RefreshDatabase;

  public function setUp() : void
  {
    parent::setUp();
    $this->artisan('db:seed');
    $this->rules = (new ContactpointRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test'
    ]);

    $this->be($user);
  }

  public function test_contactpoint_screen_can_be_rendered()
  {
    $this->assertAuthenticated();
    $response = $this->get('/contactpoint/create/1');     // deze test gaat ervan uit dat er een contact met het
                                                              // id = 1 in de database staat. anders zal deze fallen
    $response->assertStatus(200);
  }

  public function test_create_contactpoint_fails_date_in_future()
  {
    $response = $this
      ->post(route('contactpoint.store'), [
        'dateOfContact' => date('Y-m-d', strtotime('+1 days'))
      ]);
    $response->assertSessionHasErrors([
      'dateOfContact'
    ]);
  }

  public function test_create_contactpoint_fails_description_too_short()
  {
    $response = $this
      ->post(route('contactpoint.store'), [
        'description' => 'e'
      ]);
    $response->assertSessionHasErrors([
      'description'
    ]);
  }

  public function test_create_contactpoint_fails_description_too_long()
  {
    $response = $this
      ->post(route('contactpoint.store'), [       // limit is set to 255 bytes, this lorum ipsum text is 256 bytes
        'description' =>
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et tellus id dui pulvinar sagittis. Fusce sit amet turpis dignissim, ornare velit id, eleifend eros. Maecenas sed dolor urna. Donec varius ligula id elit ultrices, a imperdiet ante turpis duis.'
      ]);
    $response->assertSessionHasErrors([
      'description'
    ]);
  }

  public function test_create_contactpoint_success()
  {
    $testDescription = Str::random(100);

    $response = $this
      ->post(route('contactpoint.store'), [
        'contactid' => 1,
        'dateOfContact' => date('Y-m-d', strtotime('-1 days')),
        'description' => $testDescription
      ]);

    $response->assertSessionDoesntHaveErrors();

    $this->assertDatabaseHas('contactpoints', [
      'description' => $testDescription
    ]);
  }
}
