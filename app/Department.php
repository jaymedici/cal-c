<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Department extends Model
{
    //
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'updated_by',
        'updated_at',
    ];
}
