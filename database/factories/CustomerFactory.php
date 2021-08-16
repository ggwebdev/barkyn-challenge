<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'name'          => $this->faker->firstName($gender) .' '. $this->faker->lastName($gender),
            'email'         => $this->faker->unique()->safeEmail,
            'birth_date'    => $this->faker->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
            'gender'        => $gender,
        ];
    }
}
