<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Site;
use App\Model\User;

class UserSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'site_id',
        'updated_by',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
