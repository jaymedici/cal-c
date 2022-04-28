<?php

namespace Database\Factories;

use App\Models\Site;
use App\Models\VisitSetting;
use App\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $markedBy = $markedDate = $actualVisitDate = null;

        $participantIDs = ['TESTf/100','TESTf/101','TESTf/102','TESTf/103','TESTf/104',];

        $visit = VisitSetting::factory()->create();

        $enrolmentDate = $this->faker->dateTimeBetween('-20 weeks', '+2 weeks');
        $enrolmentDate = $enrolmentDate->format('Y-m-d');
        $visitDate = date('Y-m-d', strtotime($enrolmentDate . ' + ' . $visit->days_from_first_visit . 'days'));
        $windowStartDate = date('Y-m-d', strtotime($visitDate . ' - ' . $visit->minus_window_period . 'days'));
        $windowEndDate = date('Y-m-d', strtotime($visitDate . ' + ' . $visit->plus_window_period . 'days'));

        $dateToday = Carbon::now()->toDateString();
        
        if($dateToday >= $visitDate)
        {
            $visitStatus = $this->faker->randomElement(['Missed', 'Completed']);
        }
        elseif($dateToday < $visitDate)
        {
            $visitStatus = "Pending";
        }

        if($visitStatus == "Completed")
        {
            $actualVisitDate = $this->faker->dateTimeBetween($windowStartDate, $windowEndDate);
        }

        if($visitStatus == "Completed"  || $visitStatus == "Missed")
        {
            $markedBy = $this->faker->userName();
            $markedDate = $actualVisitDate;
        }

        return [
            //
            'participant_id' => $this->faker->randomElement($participantIDs),
            'project_id' => Project::factory()->create()->id,
            'site_id' => Site::factory()->create()->id,
            'visit_id' => $visit->id,
            'visit_date' => $visitDate,
            'actual_visit_date' => $actualVisitDate,
            'window_start_date' => $windowStartDate,
            'window_end_date' => $windowEndDate,
            'visit_status' => $visitStatus,
            'marked_by' => $markedBy,
            'marked_date' => $markedDate,
            'updated_by' => $this->faker->userName()
        ];
    }
}
