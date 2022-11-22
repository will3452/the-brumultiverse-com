<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'user_id' => 1,
            'account_id' => 1,
            'type' => 'Author',
            'description' => $this->faker->paragraph(5),
            'status' => $this->faker->shuffle(['For Approval', 'Banned', 'Active', 'In-Active', 'Declined'])[0],
        ];
    }
}
