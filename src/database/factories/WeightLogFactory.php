<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>1,
            'date'=>$this->faker->date('Y-m-d'),
            'weight'=>$this->faker->randomFloat(1, 30.0, 200.0),
            'calories'=>$this->faker->numberBetween(100, 3000),
            'exercise_time'=>$this->faker->time('H:i:s'),
            'exercise_content'=>$this->faker->sentence()
        ];
    }
}