<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use App\VisitSetting;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'include_screening',
        'updated_by',
        'updated_at',
    ];

    //MODEL RELATIONSHIPS
    public function visits()
    {
        return $this->hasMany(VisitSetting::class);
    }
    
}
