<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;

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

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_sites');
    }
}
