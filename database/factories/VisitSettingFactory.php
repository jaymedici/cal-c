<?php

namespace Database\Factories;

use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitSettingFactory extends Factory
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
            'project_id' => Project::factory()->create()->id,
            'visit_type' => $this->faker->word(),
            'visit_name' => $this->faker->word(),
            'days_from_first_visit' => $this->faker->numberBetween(1, 90),
            'plus_window_period' => $this->faker->randomDigit(),
            'minus_window_period' => $this->faker->randomDigit(),
            'updated_by' => $this->faker->userName()
        ];
    }
}
