<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;
use App\Models\PatientVisit;

class VisitSetting extends Model
{
    //
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

    public function patientVisits()
    {
        return $this->hasMany(PatientVisit::class);
    }
}
