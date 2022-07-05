<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use Auth;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'district',
        'region',
        'country',
        'updated_by'
    ];

    public function assignUsers(array $userIds)
    {
        foreach ($userIds as $key => $userId)
        {
            try {
                UserSite::create(
                    ['user_id' => $userId,
                    'site_id' => $this->id,
                    'updated_by' => Auth::user()->username,] 
                );
            }
            catch(\Exception $exception)
            {
                return back()->withinput()->with('error_message','Sorry! An error occured while assigning one or more users to this site');
            }
        }
    }

    //SCOPES
    public function scopeWhereAssignedTo($query, $userId)
    {
        return $query->whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }); 
    }

    //MODEL RELATIONSHIPS
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_sites');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_sites');
    }
}
