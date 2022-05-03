<?php

namespace Database\Factories;

use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $breakScreening, $screeningVisitLabels = null;

    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $includeScreening = $this->faker->randomElement(['Yes', 'No']);

        if($includeScreening == "Yes")
        {
            $this->breakScreening = $this->faker->randomElement(['Yes', 'No']);
        }

        if($this->breakScreening == "Yes")
        {
            $this->screeningVisitLabels = 'Screening;Pre-randomization';
        }

        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'include_screening' => $includeScreening,
            'break_screening' => $this->breakScreening,
            'screening_visit_labels' => $this->screeningVisitLabels,
            'updated_by' => $this->faker->safeEmail()   
        ];
    }
}
