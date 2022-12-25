<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'user_id' => $this->faker->numberBetween(0, 50),
                'title' => $this->faker->word(),
                'content' => $this->faker->text(),
                'rate' => $this->faker->randomDigit(),
                'release_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
