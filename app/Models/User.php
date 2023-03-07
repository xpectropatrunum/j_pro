<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
        'system_id',
        'enable',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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
    ];
    function token(){
        return $this->hasOne(ResetToken::class);
    }
    function projects(){
        return $this->hasMany(Project::class, "supervisor_id", "id");
    }
    function logs(){
        return $this->hasMany(Log::class, "user_id", "id");
    }
    function offs(){
        return $this->hasMany(Off::class, "user_id", "id");
    }
    function leaves(){
        return $this->hasManyThrough(Leave::class, Log::class);
    }
    function letter_subjects(){
        return $this->hasMany(LetterSubject::class, "supervisor_id", "id");
    }
    function letters(){
        return $this->hasMany(Letter::class);
    }
    function super_letters(){
        return $this->hasMany(Letter::class, "supervisor_id", "id");
    }
    
    function supervisor(){
        return $this->belongsToMany(User::class, SupervisorUser::class, "user_id", "supervisor_id");
    }
    function setting(){
        return $this->hasOne(Setting::class);
    }
}
