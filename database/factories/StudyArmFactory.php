<?php

namespace Database\Factories;

use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyArmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'project_id' => Project::factory()->create()->id,
        ];
    }
}
