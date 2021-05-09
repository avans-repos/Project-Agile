<?php

namespace Database\Factories\contact;

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
          'initials' => strtoupper($first_name[0].$first_name[1].$first_name[2]),
          'firstname' => $first_name,
          'lastname' => $this->faker->lastname,
          'gender' => 'man',
          'email' => $this->faker->unique()->safeEmail,
          'phonenumber' => mt_rand(10000000, 199999999),
          'type' => 'warm',
        ];
    }
}
