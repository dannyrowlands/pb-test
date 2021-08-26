<?php

namespace Database\Factories;

use App\Models\Date;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Time;
use App\Models\Endtime;

class DateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Date::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('1 day', '100 days'),
            'time_id' => Time::factory()->make(),
            'endtime_id' => Endtime::factory()->make(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-10 days'),
            'updated_at' => $this->faker->dateTimeBetween('-9 days', '-1 days'),
        ];
    }
}
