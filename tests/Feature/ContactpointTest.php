<?php

namespace Tests\Feature;
use App\Models\Contactpoint;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ContactpointTest extends TestCase
{
  use RefreshDatabase;

  public function setUp() : void
  {
    parent::setUp();
    $this->artisan('migrate:fresh --seed');
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
      ->post(route('contactpoint.store'), [       // limit is set to 5000 bytes, this lorum ipsum text is 5001 bytes
        'description' => '
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer hendrerit sapien at ex ullamcorper, a accumsan lectus mollis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque imperdiet nulla non luctus condimentum. Nullam laoreet eros nisl, vitae molestie sapien consequat et. Suspendisse iaculis massa ipsum, eget congue orci auctor a. Nulla facilisi. Vivamus suscipit est vel risus consequat gravida. Vivamus gravida est ac cursus fringilla.
Pellentesque diam lacus, mollis ac ex a, congue commodo enim. In ac sem nulla. Sed ut maximus odio. Phasellus in congue libero. Cras volutpat elit diam. Vestibulum rutrum, quam ac congue aliquam, nunc neque blandit dolor, in auctor arcu libero id neque. Aliquam eu sollicitudin quam, ac pellentesque mi.
Duis porttitor est vitae sagittis blandit. Suspendisse pretium fermentum libero id accumsan. Donec in justo sodales, aliquet ante ac, lacinia mi. Aliquam in elementum orci, ac gravida leo. Pellentesque pulvinar, massa sed varius hendrerit, risus orci ornare libero, sit amet lacinia elit mi id lacus. Curabitur sollicitudin, erat vel suscipit dapibus, elit enim mollis lorem, eget pretium urna ante non purus. Quisque cursus mollis augue, et rutrum sapien accumsan a.
Maecenas nec congue arcu. Mauris auctor augue turpis, at ullamcorper nisi ornare sed. Ut eu aliquet dui. Proin consectetur sodales nisi vitae facilisis. Proin suscipit enim eu nunc fermentum fermentum. Fusce blandit lacinia dui, sit amet porttitor nunc faucibus a. Fusce sed mi id diam rhoncus pulvinar. Nam ex urna, faucibus quis leo nec, eleifend mattis elit. Donec at mollis felis. Fusce vitae fermentum dolor. Fusce porttitor aliquet facilisis. Vestibulum sed tempor orci.
Nunc vitae semper velit. Maecenas rhoncus erat ut lorem sagittis, et varius lacus fermentum. Proin a justo sed tortor rutrum pulvinar vel vel urna. Quisque ac urna sit amet arcu auctor porttitor et nec lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin turpis dolor, dignissim ut lacinia rutrum, iaculis et elit. Duis sed dictum urna, et pulvinar ex. Vivamus semper, justo eget vulputate rhoncus, massa erat faucibus enim, in pharetra risus nunc eget mauris. Sed facilisis mollis sem, in blandit tortor suscipit in. Cras ultricies, lacus a suscipit dapibus, mauris nibh congue urna, at interdum ex tortor porttitor ipsum. Cras tristique risus eget eros accumsan tempor eu id felis. Cras vitae fringilla nisl, vel dapibus odio. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
Pellentesque arcu nisl, sagittis sit amet luctus ac, fermentum ut augue. Maecenas erat quam, facilisis in lorem in, maximus porttitor enim. Nunc quis efficitur lorem. Maecenas ultrices sagittis consectetur. Donec rutrum mattis eleifend. Nunc semper ullamcorper condimentum. In hac habitasse platea dictumst. Curabitur vestibulum placerat dui quis egestas. Mauris et sapien at risus dapibus cursus. Proin sit amet diam mi. In leo lorem, lacinia quis malesuada eget, scelerisque in metus. Aliquam venenatis ultricies egestas. Nam pretium eget urna non pretium. Curabitur ac tempor ligula, eget vulputate purus. In fringilla justo quis tortor viverra, eu fringilla mi aliquam. Quisque luctus congue dolor sed aliquam.
Curabitur sit amet velit iaculis, vehicula elit quis, congue sapien. Quisque a euismod sapien, non gravida sem. Curabitur eget lobortis nulla. Integer congue rhoncus scelerisque. In imperdiet ultrices nunc. Fusce varius euismod libero a accumsan. Sed porttitor lectus ut pellentesque luctus. Integer hendrerit velit lacus, egestas porttitor massa bibendum in. Mauris quis urna vel felis mollis aliquet. Suspendisse tempor ex vitae nulla rutrum, vitae ultrices augue auctor. Morbi in metus justo. Curabitur dignissim massa eu ex ornare faucibus. Mauris at ante sagittis, vestibulum justo eget, semper velit. Cras eleifend, tellus et egestas condimentum, massa est tristique massa, id tristique odio tortor non mi.
Praesent laoreet sapien faucibus est viverra facilisis. Nam bibendum turpis vitae sem pretium, eget fermentum velit egestas. Phasellus in ex ornare, consectetur sem vitae, dignissim ex. Etiam egestas turpis vestibulum lacus ullamcorper aliquet. Suspendisse quis felis et lorem malesuada iaculis. Ut mi diam, mattis vel porta eget, faucibus ac neque. Sed quis elit orci.
Fusce feugiat nec libero ut eleifend. Etiam non pulvinar leo. Suspendisse ut neque accumsan, efficitur mauris id, fringilla arcu. Aenean vitae lacus fringilla, rhoncus ex sed, vulputate dui. Donec tempor in libero nec posuere. Nulla non lectus nibh. Vestibulum porttitor, neque sit amet congue ornare, eros risus egestas leo, vitae hendrerit nisi lectus a lacus. Nullam auctor odio vel nisi dapibus, in gravida lectus auctor. Mauris sed eros ante. Maecenas sit amet nunc eget eros ultricies bibendum eu ut est. Vivamus dictum est eu diam mollis iaculis. Nunc consectetur vel eros nec viverra. Nam dolor. '
      ]);
    $response->assertSessionHasErrors([
      'description'
    ]);
  }

  public function test_create_contactpoint_succes()
  {
    $testDescription = Str::random(250);

    $response = $this
      ->post(route('contactpoint.store'), [
        'dateOfContact' => date('Y-m-d'),
        'description' => $testDescription
      ]);
    $response->assertSessionDoesntHaveErrors();
  }
}
