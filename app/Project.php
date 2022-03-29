<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\VisitSetting;
use App\Models\ParticipantVisit;
use App\UserProject;
use App\Models\Site;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'include_screening',
        'break_screening',
        'screening_visit_labels',
        'updated_by',
        'updated_at',
    ];

    public function enrolledParticipants()
    {
        return ParticipantVisit::where('project_id', $this->id)
                                ->get()
                                ->unique('participant_id');
    }

    public function screenedParticipants()
    {
        return Screening::where('project_id', $this->id)
                            ->get()
                            ->unique('participant_id');
    }

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
