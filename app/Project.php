<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\VisitSetting;
use App\Models\ParticipantVisit;
use App\UserProject;
use App\Models\Site;
use App\Models\Screening;
use App\Models\ProjectSite;
use App\Observers\ProjectObserver;
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

    public function assignManagers(array $managers)
    {
        foreach($managers as $key => $managerId)
        {
            try{
                UserProject::create([
                    'user_id' => $managerId,
                    'project_id' => $this->id,
                    'project_role' => 'manager',
                    'updated_by' => auth()->user()->username,
                    ]);
            }
            catch(\Exception $exception)
            {
                return back()->with('error_message','Sorry! An Error occured when assigning managers!');
            }
        }
    }

    public function assignSites(array $sites)
    {
        foreach($sites as $key => $siteId)
        {
            try{
                ProjectSite::create([
                    'site_id' => $siteId,
                    'project_id' => $this->id,
                    'updated_by' => auth()->user()->username,
                    ]);
            }
            catch(\Exception $exception)
            {
                return back()->withinput()->with('error_message','Sorry! An Error Occured when assigning Sites');
            }
        }
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
