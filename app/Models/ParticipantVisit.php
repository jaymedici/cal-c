<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\VisitSetting;
use App\Models\Site;
use App\Models\Appointment;

class ParticipantVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'participant_id',
        'project_id',
        'site_id',
        'visit_id',
        'visit_date',
        'actual_visit_date',
        'visit_status',
        'window_start_date',
        'window_end_date',
        'updated_by',
    ];

    //SCOPES
    public function scopeWhereProjectAssignedTo($query, $userId)
    {
        return $query->whereHas('project', function ($query) use ($userId) {
            $query->isAssigned($userId);
            });
    }


    //MODEL RELATIONSHIPS
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function visit()
    {
        return $this->belongsTo(VisitSetting::class, 'visit_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }

}
