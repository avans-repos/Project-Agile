<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_getDeleteText_No_Relations()
    {
      $newProject = new Project();
      $newProject->name = 'test1';
      $this->assertEquals('Weet u zeker dat u "test1" wilt verwijderen<br>', $newProject->getDeleteText());
    }
}
