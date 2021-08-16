<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $ch = curl_init('https://dog.ceo/api/breeds/image/random');
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => 1,
        ]);
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $photo  = $response['message'];
        $breed  = explode('/', explode('/breeds/', $photo)[1])[0];
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'subscription_id'   => $this->faker->numberBetween(1, Subscription::count()),
            'name'              => $this->faker->firstName($gender),
            'gender'            => $gender,
            'photo'             => $photo,
            'breed'             => ucwords(str_replace('-', ' ', $breed)),
            'birth_date'        => $this->faker->dateTimeBetween('-10 years', '-1 week')->format('Y-m-d'),
            'lifestage'         => $this->faker->randomElement(['Puppy', 'Adult', 'Senior']),
            'activity'          => $this->faker->randomElement(['Lazy', 'Normal', 'Active']),
            'body_type'         => $this->faker->randomElement(['Skinny', 'Normal', 'Fat']),
            'weight'            => $this->faker->randomFloat(3, $min = 3, $max = 20),
        ];
    }
}
