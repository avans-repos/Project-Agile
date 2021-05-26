<?php

namespace Database\Factories;

use App\Models\Actionpoint;
use App\Models\Company;
use App\Models\teacher_has_actionpoints;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class teacher_has_actionpointsFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = teacher_has_actionpoints::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $userId = User::role('Teacher')->get()->random(1)[0]->id;
    $actionpointId = Actionpoint::all()->random(1)[0]->id;
    $actionpoint = teacher_has_actionpoints::all()->where('userid', $userId)->where('actionpointid', $actionpointId)->first();
    if($actionpoint == null || !$actionpoint->exists()) {
      return [
        'userid' => $userId,
        'actionpointid' => $actionpointId,
      ];
    }
  }
}
