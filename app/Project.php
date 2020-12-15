<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'pi1',
        'pi1_status',
        'description',
        'pi1_return_date',
        'pi2',
        'department',
        'updated_by',
        'updated_at',
    ];
    public function pi()
    {
        return $this->belongsTo(User::class, 'pi1');
    }
    public function pis()
    {
        return $this->belongsTo(User::class, 'pi2');
    }
    public function dept()
    {
        return $this->belongsTo(Department::class, 'department');
    }
}
