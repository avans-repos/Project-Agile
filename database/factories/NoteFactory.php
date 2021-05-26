<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use App\Models\contact\Contact;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Note::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'description' => $this->faker->text($this->faker->numberBetween(100, 1000)),
      'creator' => User::all()->random(1)[0]->id,
      'creation' => $this->faker->dateTimeBetween('-1 day', 'now'),
    ];
  }
}
