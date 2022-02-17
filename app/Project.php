<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use App\VisitSetting;
use App\Models\ParticipantVisit;
use App\UserProject;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'include_screening',
        'break_screening',
        'screening_visit_labels',
        'updated_by',
        'updated_at',
    ];

    //MODEL RELATIONSHIPS
    public function visits()
    {
        return $this->hasMany(VisitSetting::class);
    }

    public function participantVisits()
    {
        return $this->hasMany(ParticipantVisit::class);
    }

    public function assignees()
    {
        return $this->hasMany(UserProject::class);
    }
    
}
