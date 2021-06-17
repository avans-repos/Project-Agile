<?php

namespace Tests\Unit;

use App\Models\Actionpoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

class ActionpointTest extends TestCase
{
  use CreatesApplication;
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();
  }

  public function test_getDeleteText()
  {
    $actionpoint = Actionpoint::all()->first();
    $this->assertEquals('Weet u zeker dat u "{$actionpoint->title}" wilt verwijderen<br>', $actionpoint->getDeleteText());
  }
}
