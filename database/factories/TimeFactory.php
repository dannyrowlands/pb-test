<?php

namespace Database\Factories;

use App\Models\Time;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Time::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'time' => $this->faker->Time(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-10 days'),
            'updated_at' => $this->faker->dateTimeBetween('-9 days', '-1 days'),
        ];
    }
}
