<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class SupervisorUser extends Model
{

    public $table = "supervisor_user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supervisor_id',
        'user_id',
    ];
    function supervisor(){
        return $this->belongsTo(User::class, "supervisor_id");
    }
    function user(){
        return $this->belongsTo(User::class, "user_id");
    }
 
}
