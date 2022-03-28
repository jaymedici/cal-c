<?php

namespace App\Console\Commands;

use App\Models\ParticipantVisit;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkOverduePendingVisitsAsMissed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark_visits_as_missed:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark overdue pending visits as missed';

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
        $todayDate = Carbon::now();
        $overduePendingVisits = ParticipantVisit::where('visit_status', 'LIKE', 'Pending')
                            ->whereDate('window_end_date', '<', $todayDate)
                            ->get();

        foreach($overduePendingVisits as $overduePendingVisit)
        {
            $attributes['visit_status'] = 'Missed';
            $attributes['marked_by'] = 'SYSTEM';
            $attributes['marked_date'] = $todayDate->toDateString();
            $attributes['updated_by'] = 'SYSTEM';

            $overduePendingVisit->update($attributes);
        }
    }
}
