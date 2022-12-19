<?php

namespace App\Console\Commands;

use App\Models\ParticipantVisit;
use App\Models\VisitSetting;
use App\Services\ParticipantVisitsService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class RecalculateParticipantVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate selected participant visits';
    
    /**
     * Participants visits to be recalculated
     *
     * @return ParticipantVisit
     */
    protected function getParticipantVisits(): Collection
    {
        return ParticipantVisit::where('project_id', 1)
                                ->where([
                                        ['visit_id', 15],
                                        ['visit_id', 16],
                                        ['visit_id', 18],
                                        ['visit_id', 20],
                                        ['visit_id', 22],
                                        ['visit_id', 24]
                                    ])
                                ->get();
    }
    
    /**
     * Project visits to be used for the participant visit recalculation
     *
     * @return VisitSetting
     */
    protected function getProjectVisits(): Collection
    {
        return VisitSetting::where('project_id', 1)
                            ->where('visit_name', 'LIKE', 'Telephonic call%')
                            ->get();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $participantVisits = $this->getParticipantVisits();
        $projectVisits = $this->getProjectVisits();

        ParticipantVisitsService::recalculateParticipantVisitSchedule(
            $participantVisits, $projectVisits);

        $this->info('Participant Visits recalculated successfully');
    }
}
