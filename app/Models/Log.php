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
    function leave()
    {
        return $this->hasOne(Leave::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function project()
    {
        return $this->belongsTo(Project::class);
    }
    function getLeaveTimeAttribute()
    {
        if (!$this->leave) {
            $end_time = $this->user->supervisor()->first()->setting?->end_time ?? "21:00";
            if(strtotime(date("Y-m-d H:i")) >= strtotime($this->date  . " ".env("MAX_WORKING_HOUR"))){
                if (time() - strtotime($this->date  . " " . $end_time) > 0) {
                    if (strtotime($this->date . " " . $end_time) - strtotime($this->date . " " . $this->time) > 0) {
                        return $this->date  . " ". $end_time;
                    }
                }
            }
           
            return null;
        }
        return $this->leave->created_at;
    }
    function getDurationAttribute()
    {
        if (!$this->leave) {
            $end_time = $this->user->supervisor()->first()->setting?->end_time ?? "17:00";
            if (time() - strtotime($this->date  . " " . $end_time) > 0) {
                $r = gmdate("H:i:s",  abs(strtotime($this->date . " " . $end_time) - strtotime($this->date . " " . $this->time)));
                if (strtotime($this->date . " " . $end_time) - strtotime($this->date . " " . $this->time) > 0) {
                    return $r;
                }
            }

            return 0;
        }
        return gmdate("H:i", abs(strtotime($this->leave->created_at) - strtotime($this->date . " " . $this->time)));
    }
    function getDurationInSecondsAttribute()
    {
        if (!$this->leave) {
            $end_time = $this->user->supervisor()->first()->setting?->end_time ?? "17:00";
            if (time() - strtotime($this->date  . " " . $end_time) > 0) {
                $r = abs(strtotime($this->date . " " . $end_time) - strtotime($this->date . " " . $this->time));
                if (strtotime($this->date . " " . $end_time) - strtotime($this->date . " " . $this->time) > 0) {
                    return $r;
                }
            }

            return 0;
        }
        return abs(strtotime($this->leave->created_at) - strtotime($this->date . " " . $this->time));
    }
}
