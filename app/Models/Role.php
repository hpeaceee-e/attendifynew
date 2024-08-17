<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{


    protected $fillable = [
        'name',
    ];

    // Definisikan relasi jika ada, misalnya ke User
    public function users()
    {
        return $this->hasMany(User::class, 'role');
    }
}
