<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'shift_name',
        'singkatan',

    ];


    public function users()
    {
        return $this->hasMany(User::class, 'schedule');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id'); // Asumsi ada 'schedule_id' di tabel users
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function days()
    {
        return $this->hasMany(ScheduleDayM::class, 'schedule_id', 'id');
    }
}
