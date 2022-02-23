<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use App\VisitSetting;
use App\Models\ParticipantVisit;
use App\UserProject;
use App\Models\Site;
use App\Models\ProjectSite;

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

    //SCOPES
    public function scopeIsAssigned($query, $userId)
    {
        return $query->whereHas('assignees', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }

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

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'project_sites');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects');
    }
    
}
