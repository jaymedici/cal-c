<?php

namespace App;
use App\Project;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserProject extends Model
{
    //
    
    protected $fillable = [
        'id',
        'project_id',
        'project_role',
        'user_id',
        'updated_by',
        'updated_at',
    ];
    
    public function userInfo()
    {
            return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function visit()
    {
        //return $this->belongsTo(Calendar::class, 'project_id');
        return $this->hasMany(Calendar::class, 'project_id', 'project_id');
    }
}
