<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\ParticipantVisit;
use Illuminate\Console\Command;
use Faker\Generator as Faker;

class GenerateDummyAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:generate {participantVisits=1} {--project=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dummy participant visit appointments for testing purposes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Faker $faker)
    {
        $projectId = $this->option('project');
        $participantVisits = $this->argument('participantVisits');
        $participantVisitsWithNoAppointment = ParticipantVisit::where('project_id', $projectId)
                                                            ->whereDoesntHave('appointment')
                                                            ->with('visit')
                                                            ->get();

        for($i=1; $i <= $participantVisits; $i++)
        {
            $randomParticipantVisit = $participantVisitsWithNoAppointment->random();

            $appointmentDateTime = $faker->dateTimeBetween($randomParticipantVisit->window_start_date, 
                                        $randomParticipantVisit->window_end_date);

            Appointment::create([
                'participant_id' => $randomParticipantVisit->participant_id,
                'project_id' => $randomParticipantVisit->project_id,
                'site_id' => $randomParticipantVisit->site_id,
                'participant_visit_id' => $randomParticipantVisit->id,
                'screening_id' => null,
                'appointment_date_time' => $appointmentDateTime,
                'updated_by' => 'AutoGenerator'
            ]);

            $this->info('Appointment Created for: ' . $randomParticipantVisit->participant_id
                         . ', on visit: ' . $randomParticipantVisit->visit->visit_name);
        }

        $this->info('Appointment(s) Created Successfully!');
    }
}
