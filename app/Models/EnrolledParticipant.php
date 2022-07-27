<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'project_id',
        'study_arm_id',
        'site_id',
        'updated_by'
    ];

    //SCOPES
    public function scopeWhereSiteAssignedTo($query, $userId)
    {
        return $query->whereHas('site', function ($query) use ($userId) {
            $query->whereAssignedTo($userId);
            });
    }

    //MODEL RELATIONSHIPS
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function studyArm()
    {
        return $this->belongsTo(StudyArm::class, 'study_arm_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
