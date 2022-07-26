<?php

namespace App\Console\Commands;

use App\Models\EnrolledParticipant;
use App\Models\ParticipantVisit;
use Illuminate\Console\Command;

class PopulateEnrolledPartipantIdOnParticipantVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:enrolled_participant_id {--project=6}';

    protected $sampleCommand = 'php artisan populate:enrolled_participant_id --project=6';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate enrolled participant id field on participant visits table';

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
    public function handle()
    {
        $projectId = $this->option('project');
        $participantVisits = ParticipantVisit::where('project_id', $projectId)->get();
        $enrolledParticipants = EnrolledParticipant::all();

        foreach ($enrolledParticipants as $enrolledParticipant)
        {
            foreach ($participantVisits as $participantVisit)
            {
                if ($participantVisit->participant_id == $enrolledParticipant->participant_id)
                {
                    $participantVisit->update([
                        'enrolled_participant_id' => $enrolledParticipant->id
                    ]);
                }
            }
        }

        $this->info('Records updated successfully!');
    }

}
