<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Models\Site;
use App\Models\ParticipantVisit;
use App\Models\Screening;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'participant_id',
        'project_id',
        'site_id',
        'participant_visit_id',
        'screening_id',
        'appointment_date_time',
        'updated_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function participantVisit()
    {
        return $this->belongsTo(ParticipantVisit::class);
    }

    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }
}
