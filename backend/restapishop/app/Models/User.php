<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'github_id',
        'google_id',
        'auth_type',
        'is_admin',
        'email_verified_at',
        'fcm_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->is_admin = ($user->is_admin === null || $user->is_admin === false) ? false : $user->is_admin;
            $user->avatar = $user->avatar === null ? 'default_avatar.jpg' : $user->avatar;
            $user->auth_type = $user->auth_type === null ? 'auth' : $user->auth_type;
        });
    }

    public function is_admin()
    {
        return $this->is_admin;
    }
    public function get_fcm()
    {
        return $this->fcm_id;
    }
}
