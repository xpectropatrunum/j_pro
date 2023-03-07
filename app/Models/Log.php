<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Log extends Model
{

    public $table = "logs";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'date',
        'time',
    ];
    function leave(){
        return $this->hasOne(Leave::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
    function project(){
        return $this->belongsTo(Project::class);
    }
    function getDurationAttribute(){
        if(!$this->leave){
            $end_time = $this->user->supervisor()->first()->setting?->end_time ?? "17:00";
           // dd($end_time);
            return 0;
        }
        return gmdate("H:i:s", strtotime($this->leave->created_at) - strtotime($this->date . " " . $this->time))  ;

    }

 
}
