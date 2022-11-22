<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_d' => 1,
            'account_id' => 1,
            'title' => $this->faker->words(3),
            'age_restriction' => 18,
            'has_warning_message' => false,
            'category_id' => 1,
            'credit' => $this->faker->paragraph(5),
            'blurb' => $this->faker->paragraph(5),
            'language_id' => 1,
            'genre_id' => $this->faker->numberBetween(10, 15),
            'violence_level_id' => 1,
            'heat_level_id' => 1,
            'type' => 'regular',
            'cost' => 3,
            'cost_type' => 'Purple Crystal',
            'lead_character' => 'Male',
            'lead_college' => 'Integrated School',
            'published_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'pdf' => 'sample.pdf',
            'number_of_page' => $this->faker->numberBetween(5, 200),
        ];
    }
}
