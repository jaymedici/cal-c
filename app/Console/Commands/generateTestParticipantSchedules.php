<?php

namespace App\Console\Commands;

use App\Models\ParticipantVisit;
use App\Services\ParticipantVisitsService;
use Illuminate\Console\Command;
use Faker\Generator as Faker;

class generateTestParticipantSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:schedules {participantsNo=1} {--project=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Geneate dummy participant schedules for testing purposes';

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
        $participantsNo = $this->argument('participantsNo');
        $participantVisitService = new ParticipantVisitsService;

        for($i = 1; $i <= $participantsNo; $i++)
        {
            $attributes = [
                'participant_id' => $faker->numerify('PNo/Test/####'),
                'site_id' => 1,
                'first_visit_date' => ($faker->dateTimeBetween('-2 weeks', '+10 weeks'))->format('Y-m-d'),
                'mark_first_visit_complete' => 'No',
                'updated_by' => 'AutoGenerator'
            ];

            if($participantVisitService->participantIsEnrolledInProject($attributes['participant_id'], $projectId))
            {
                $this->error('Sorry! Participant already Exists!');
            }

            $participantVisitSchedule = $participantVisitService->generateParticipantVisitSchedule($attributes, $projectId);

            ParticipantVisit::insert($participantVisitSchedule);
            $this->info('Created Schedule for: ' . $attributes['participant_id']);
        }

        $this->info('Partipant(s) visit schedule(s) created successfully!');
    }
}
