<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->jobTitle();

        // Check if $name is empty or contains only whitespace
        if (empty(trim($name))) {
            // If empty, set a default name
            $name = 'Uncategorized';
        } else {
            // Split the job title into an array of words
            $nameArr = explode(' ', $name);
            // Use the first word as the category name
            $name = trim($nameArr[0]);
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
