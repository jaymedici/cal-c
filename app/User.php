<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\RequisitionRequest;
use App\Approver;
use App\Project;
use Spatie\Permission\Traits\HasRoles;
use Session;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'user_role', 'username', 'password','updated_by','user_active','department',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function requests()
    {
        return $this->hasMany(RequisitionRequest::class, 'id', 'requested_by');
    }

    public function setImitating($id)
    {
        Session::put('imitate', $id);
    }


    public function stopImitating()
    {
        Session::forget('imitate');
    }


    public function isImitating()
    {
        return Session::has('imitate');
    }
}
