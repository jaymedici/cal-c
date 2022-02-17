<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\VisitSetting;

class ParticipantVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'participant_id',
        'project_id',
        'site_name',
        'visit_id',
        'visit_date',
        'actual_visit_date',
        'visit_status',
        'window_start_date',
        'window_end_date',
        'updated_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function visit()
    {
        return $this->belongsTo(VisitSetting::class, 'visit_id');
    }
}
