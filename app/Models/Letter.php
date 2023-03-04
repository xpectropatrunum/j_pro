<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Letter extends Model
{

    public $table = "letters";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'letter_subject_id',
        'project_id',
        'number',
        'date',
    ];
    function letter_subject(){
        return $this->belongsTo(LetterSubject::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
    function project(){
        return $this->belongsTo(Project::class);
    }
}
