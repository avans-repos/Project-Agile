<?php

namespace Database\Factories\contact;

use App\Models\Address;
use App\Models\contact\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Contact::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $first_name = $this->faker->firstName;
    return [
      'initials' => strtoupper(substr($first_name, 0, 3)),
      'firstname' => $first_name,
      'lastname' => $this->faker->lastname,
      'gender' => 'man',
      'email' => $this->faker->unique()->safeEmail,
      'phonenumber' => $this->faker->e164PhoneNumber,
      'type' => rand(0, 1) == 1 ? 'warm' : 'koud',
      'address' => rand(0, 1) == 1 ? Address::all()->random(1)[0]->id : null,
    ];
  }
}
