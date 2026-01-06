<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ISBN' => $this->faker->isbn13(),
            'title' => $this->faker->text(70),
            'price' => $this->faker->randomFloat(2 , 0 ,99),
            'mortgage' => $this->faker->randomFloat(2 , 0 ,9999),
            'category_id' => Category::all()->random()->id
        ];
    }
}
