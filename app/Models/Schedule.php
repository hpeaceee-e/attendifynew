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
        'clock_in',
        'clock_out',
        'break',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'schedule');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
