<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Models\Site;

class Screening extends Model
{
    use HasFactory;

    protected $table = 'screening';

    protected $fillable = [
        'screening_date',
        'participant_id',
        'project_id',
        'site_id',
        'screening_label',
        'still_screening',
        'next_screening_date',
        'screening_outcome',
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
