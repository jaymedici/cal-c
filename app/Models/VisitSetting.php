<?php

namespace App\Models;

use App\Project;
use Illuminate\Database\Eloquent\Model;
use App\Models\PatientVisit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'project_id',
        'visit_type',
        'visit_name',
        'days_from_first_visit',
        'plus_window_period',
        'minus_window_period',
        'updated_by',
        'updated_at',
    ];

    //MODEL RELATIONSHIPS
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function participantVisits()
    {
        return $this->hasMany(ParticipantVisit::class);
    }
}
