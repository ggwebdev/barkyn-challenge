<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    public function getWeight($price){
        switch ($price) {
            case 20: return 3; break;
            case 30: return 6; break;
            case 45: return 12; break;
        }
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $base_price     = $this->faker->randomElement([20, 30, 45]);
        $last_order     = $this->faker->dateTimeBetween('-1 month', '-1 day')->format('Y-m-d');
        $discount       = 15; // Percentual discount
        return [
            'customer_id'        => $this->faker->unique()->numberBetween(1, Customer::count() - 1),
            'base_price'         => $base_price,
            'total_price'        => $base_price - ($base_price * ($discount / 100)),
            'weight'             => $this->getWeight($base_price),
            'protein'            => $this->faker->randomElement(['chicken', 'salmon']),
            'last_order_date'    => $last_order,
            'next_order_date'    => date('Y-m-d', strtotime($last_order . ' +4 weeks')),
        ];
    }
}
