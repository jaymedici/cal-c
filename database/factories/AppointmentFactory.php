<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\ParticipantVisit;

class AppointmentFactory extends Factory
{
    public function getParticipant()
    {
        //Write logic for getting participant either from enrollment or screening
    }
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $participant = ParticipantVisit::factory()->create();

        $appointmentDateTime = $this->faker->dateTimeBetween(
                            $participant->window_start_date, $participant->window_end_date);

        return [
            //
            'participant_id' => $participant->participant_id,
            'project_id' => $participant->project_id,
            'site_id' => $participant->site_id,
            'participant_visit_id' => $participant->id,
            'screening_id' => null,
            'appointment_date_time' => $appointmentDateTime,
            'updated_by' => $this->faker->userName()
        ];
    }
}
