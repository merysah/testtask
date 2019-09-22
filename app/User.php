<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'password',
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

    protected $attributes = [
        'role' => 1
    ];

    public function getRoleAttribute($attribute)
    {
        return $this->roleOptions()[$attribute];
    }

    public function isAdmin()
    {
        return Auth::user()->role == 'Admin' ? true : false;
    }

    public function roleOptions()
    {
        return [
            1 => 'Admin',
            2 => 'User',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
