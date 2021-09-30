<?php

namespace App;
use App\Project;
use Illuminate\Database\Eloquent\Model;
class Calendar extends Model
{
    //
    
    protected $fillable = [
        'id',
        'patient_id',
        'project_id',
        'site_name',
        'visit',
        'visit_date',
        'actual_visit_date',
        'visit_status',
        'visit_status1',
        'updated_by',
        'updated_at',
        'window_period',
        'windows_start_date',
        'windows_end_date',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
}
}
