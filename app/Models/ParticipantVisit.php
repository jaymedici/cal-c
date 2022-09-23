<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Models\VisitSetting;
use App\Models\Site;
use App\Models\Appointment;
Use Carbon\Carbon;

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
        'marked_by',
        'marked_date',
        'window_start_date',
        'window_end_date',
        'updated_by',
        'enrolled_participant_id'
    ];

    // Default type is string
    protected $casts = [
        'window_end_date' => 'date'
    ];

    public function VisitStatusCanBeEdited()
    {
        if(Carbon::now() >= $this->window_start_date)
        {
            return true;
        }

        else {
            return false;
        }
    }

    //SCOPES
    public function scopeWhereProjectAssignedTo($query, $userId)
    {
        return $query->whereHas('project', function ($query) use ($userId) {
            $query->whereAssignedTo($userId);
            });
    }

    public function scopeWhereSiteAssignedTo($query, $userId)
    {
        return $query->whereHas('site', function ($query) use ($userId) {
            $query->whereAssignedTo($userId);
            });
    }

    //ACCESSORS
    public function getWindowStartDateFormattedAttribute()
    {
        return Carbon::parse($this->window_start_date)->format('d M, Y');
    }

    public function getWindowEndDateFormattedAttribute()
    {
        return $this->window_end_date->format('d M, Y');
    }

    //To be used during appointment setting validation
    public function getValidatableEndDateAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->window_end_date . ' +23 hours'));
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

    public function participant()
    {
        return $this->belongsTo(EnrolledParticipant::class, 'enrolled_participant_id');
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }

}
