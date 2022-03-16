<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Models\User;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'user_projects';
    
    protected $fillable = [
        'id',
        'project_id',
        'user_id',
        'updated_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
