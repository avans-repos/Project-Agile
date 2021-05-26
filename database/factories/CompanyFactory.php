<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Company::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $addressId = Address::all()->random(1)[0]->id;
    return [
      'name' => $this->faker->company,
      'email' => $this->faker->companyEmail,
      'size' => $this->faker->numberBetween(5,4000),
      'phonenumber' => $this->faker->e164PhoneNumber,
      'visiting_address' => $addressId,
      'mailing_address' => $addressId,
    ];
  }
}
