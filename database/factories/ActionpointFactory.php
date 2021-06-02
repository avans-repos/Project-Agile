<?php

namespace Database\Factories;

use App\Models\Actionpoint;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionpointFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Actionpoint::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $deadline = Carbon::now()->addDays(random_int(2, 12));
    return [
      'deadline' => $deadline,
      'title' => 'Contact opnemen met ' . Company::all()->random(1)[0]->name,
      'reminderdate' => $deadline->addDays(-1),
      'creator' => User::role('Teacher')
        ->get()
        ->random(1)[0]->id,
    ];
  }
}
