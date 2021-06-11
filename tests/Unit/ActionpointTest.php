<?php

namespace Tests\Unit;

use App\Models\Actionpoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ActionpointTest extends TestCase
{
  use RefreshDatabase;

  public function test_getDeleteText()
  {
    $newActionpoint = new Actionpoint();
    $newActionpoint->title = 'test1';
    $this->assertEquals('Weet u zeker dat u "test1" wilt verwijderen<br>', $newActionpoint->getDeleteText());
  }
}
