<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text(50),
            'option_a' => $this->faker->text(10),
            'option_b' => $this->faker->text(10),
            'option_c' => $this->faker->text(15),
            'option_d' => $this->faker->text(10),
            'option_e' => $this->faker->text(10),
            'reason' => $this->faker->text(100),
            'category' => $this->faker->text(10),
        ];
    }
}
