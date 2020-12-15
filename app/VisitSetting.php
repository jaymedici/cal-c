<?php

namespace App;
use App\Project;
use Illuminate\Database\Eloquent\Model;
class VisitSetting extends Model
{
    //
    
    protected $fillable = [
        'id',
        'project_id',
        'visit_name',
        'number_of_days',
        'window_period',
        'updated_by',
        'updated_at',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
}
}
