<?php

namespace Tests\Unit;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ProjectTest extends TestCase
{
  use CreatesApplication;
  use RefreshDatabase;

  protected $seed = true;

  public function setUp(): void
  {
    parent::setUp();
    $this->rules = (new ProjectRequest())->rules();
    $this->validator = $this->app['validator'];
    $user = new User([
      'id' => 1,
      'name' => 'test',
    ]);

    $this->be($user);
  }
  public function test_getDeleteText_No_Relations()
  {
    $newProject = new Project();
    $newProject->name = 'test1';
    $this->assertEquals('Weet u zeker dat u "test1" wilt verwijderen<br>', $newProject->getDeleteText());
  }
}
