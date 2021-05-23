<?php

namespace Tests\Feature;

use App\Events\NoteAdded;
use App\Http\Requests\MailFormatRequest;
use App\Http\Requests\NoteRequest;
use App\Models\contact\Contact;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Tests\TestCase;

class MailFormatTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
    $this->rules = (new MailFormatRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test',
    ]);
    $this->user = $user;
    $this->be($user);
  }

  public function test_mailformat_without_name()
  {
    $this->assertAuthenticated();
    $response = $this->post(route('mailformat.store'), [
      'name' => '',
    ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name']);
  }
}
