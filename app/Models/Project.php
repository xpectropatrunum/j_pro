<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Project extends Model
{

    public $table = "projects";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supervisor_id',
        'x',
        'y',
        'name',
        'company_name',
        'area',
        'status',
    ];
    function supervisor(){
        return $this->belongsTo(User::class, "supervisor_id");
    }
    function logs(){
        return $this->hasMany(Log::class);
    }
 
}
