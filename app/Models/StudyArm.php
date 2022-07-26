<?php

namespace App\Models;

use App\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyArm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id'
    ];

    //MODEL RELATIONSHIPS
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function enrolledParticipants()
    {
        return $this->hasMany(EnrolledParticipant::class);
    }
}
