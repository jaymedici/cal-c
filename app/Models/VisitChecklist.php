<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitChecklist extends Model
{
    use HasFactory;

    protected $table = 'visit_checklists';

    protected $fillable = [
        'visit_id',
        'project_id',
        'checklist_item',
        'is_done',
        'item_done_date',
        'attending_doctor',
        'updated_by',
    ];
}
