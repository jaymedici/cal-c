<?php

namespace App\Console\Commands;

use App\Models\EnrolledParticipant;
use App\Models\ParticipantVisit;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class PopulateEnrolledParticipantsUsingParticipantVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:participants_from_visits {--project=6}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate enrolled participants table from participant visit records';

    protected $sampleCommand = 'php artisan populate:participants_from_visits --project=6';

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
        $participantVisits = $this->getParticipantIdUniqueParticipantVisits($projectId);
        
        $this->insertRecordsToEnrolledParticipantsTable($participantVisits);

        $this->info('Enrolled Participant Records created successfully!');
    }

    protected function getParticipantIdUniqueParticipantVisits(int $projectId)
    {
        return ParticipantVisit::where('project_id', $projectId)
                                            ->get()
                                            ->unique('participant_id');
    }

    protected function insertRecordsToEnrolledParticipantsTable(Collection $participantVisits)
    {
        foreach ($participantVisits as $participantVisit)
        {
            EnrolledParticipant::create([
                'participant_id' => $participantVisit->participant_id,
                'project_id' => $participantVisit->project_id,
                'study_arm_id' => 1,
                'site_id' => $participantVisit->site_id,
                'updated_by' => $participantVisit->updated_by
            ]);
        }
    }
}
