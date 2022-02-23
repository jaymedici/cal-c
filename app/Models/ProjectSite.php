<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Models\Site;

class ProjectSite extends Model
{
    use HasFactory;

    protected $table = 'project_sites';

    protected $fillable = [
        'id',
        'project_id',
        'site_id',
        'updated_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
