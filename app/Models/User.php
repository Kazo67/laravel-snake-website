<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\AppLog;
use App\Models\VisitorUnique;
use App\Models\UserGameData;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\EmailVerificationNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'api_token',
        'password',
        'avatar_path',
        'permission',
        'last_login_ip',
        'last_login_time',
        'last_user_agent',
        'user_banned',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }

    /**
     * Function that checks if user has admin permissions
     */
    public function isAdmin()
    {
        if ($this->permission == 2) {
            return true;
        }
        return false;
    }

    /**
     * Function that checks if user has normal permissions
     */
    public function isUser()
    {
        if ($this->permission == 0) {
            return true;
        }
        return false;
    }

    /**
     * Function that checks if user is banned
     */
    public function isBanned()
    {
        if ($this->user_banned == 1) {
            return true;
        }
        return false;
    }

    /**
     * Relation for users_game_data table
     */
    public function userGameData()
    {
        return $this->hasOne(UserGameData::class, 'user_id', 'id');
    }

    /**
     * Relation for app_logs table
     */
    public function appLogs()
    {
        return $this->hasMany(AppLog::class, 'user_id', 'id');
    }

    /**
     * Relation for unique_visitors table
     */
    public function visitorUnique()
    {
        return $this->hasOne(VisitorUnique::class, 'ip', 'last_login_ip');
    }

}
